<?php

namespace App\Http\Controllers;

use App\Models\UserMixue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function indexAdmin()
    {
        $users = UserMixue::paginate(10);
        return view('admin.user.index', compact('users', 'users'));
    }

    public function VerifyMail(Request $request)
    {
        if ($request->ajax()) {
            $validated = Validator::make($request->all(), [
                'otp' => 'required|numeric',
            ]);

            // Kiểm tra xem validation có thất bại không
            if ($validated->fails()) {
                return response()->json(['error' => 'Dữ liệu nhập không hợp lệ.']);
            }

            $otpCode = $request->input('otp');
            $user = Auth::user();

            // Nếu người dùng không tồn tại
            if (!$user) {
                return response()->json(['error' => 'Không tìm thấy người dùng.']);
            }

            // Kiểm tra mã OTP
            $otpExpiresAt = Cache::get('otp_expires_at_' . $user->user_id);
            if ($otpExpiresAt && now()->lessThan($otpExpiresAt) && $user->otp_code === $otpCode) {
                $user->verified = 1;
                $user->otp_code = null;
                $user->save();

                Auth::login($user);
                return response()->json(['success' => 'Xác thực thành công', 'redirectUrl' => url('/')]);
            } else {
                // Mã OTP không hợp lệ hoặc đã hết hạn
                return response()->json(['error' => 'Mã OTP không hợp lệ hoặc đã hết hạn.']);
            }
        }

        // Nếu không phải là AJAX request, hiển thị trang xác thực OTP
        return view('login.verifymail', ['expiresAt' => session('otp_expires_at')]);
    }

    public function getOtpExpiryTime(Request $request)
    {
        $expiresAt = session('otp_expires_at');
        if ($expiresAt) {
            return response()->json(['expiresAt' => $expiresAt * 1000]); // Chuyển đổi sang milliseconds
        }
        return response()->json(['error' => 'No OTP set or expired'], 404);
    }

    public function resendOtp(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $user = UserMixue::find($user->user_id);

        if ($user) {
            // Sinh OTP mới và cập nhật vào database
            $otpCode = rand(100000, 999999);
            $user->otp_code = $otpCode;
            $saved = $user->save();

            if ($saved) {
                // Lưu thời gian hết hạn OTP mới
                $expiresAt = now()->addMinutes(1);
                Cache::put('otp_expires_at_' . $user->user_id, $expiresAt, 60);
                session(['otp_expires_at' => $expiresAt->timestamp]);
                $expiresAtMs = $expiresAt->getTimestamp() * 1000;

                // Gửi OTP mới qua email
                try {
                    Mail::to($user->user_email)->queue(new OtpMail($user->user_name, $otpCode));
                    return response()->json(['success' => 'OTP đã được gửi lại.', 'newExpiresAt' => $expiresAtMs]);
                } catch (\Exception $e) {
                    // Trong trường hợp gửi mail thất bại
                    return response()->json(['error' => 'Có lỗi xảy ra khi gửi lại OTP.']);
                }
            } else {
                return response()->json(['error' => 'Không thể cập nhật OTP.']);
            }
        } else {
            return response()->json(['error' => 'Không tìm thấy người dùng.']);
        }
    }


    public function Login(Request $request)
    {
        $credentials = $request->only('user_email', 'user_password', 'user_status');
        $remember = $request->has('remember');

        $user = UserMixue::where('user_email', $credentials['user_email'])->first();

        if (!$user) {
            $errorMessage = 'Không có tài khoản trong cơ sở dữ liệu.';
        } elseif ($user->user_status == 0) {
            $errorMessage = 'Người dùng không có quyền truy cập.';
        } elseif (!Auth::attempt(['user_email' => $credentials['user_email'], 'password' => $credentials['user_password']], $remember)) {
            $errorMessage = 'Nhập sai mật khẩu.';
        } elseif ($user->verified == 0) {
            $currentTimestamp = now()->timestamp;
            $otpExpiresAt = session('otp_expires_at', 0);

            // Chỉ tạo và gửi OTP mới nếu OTP hiện tại đã hết hạn
            if ($currentTimestamp > $otpExpiresAt) {
                // Sinh OTP ngẫu nhiên
                $otpCode = rand(100000, 999999);

                // Lưu OTP vào database
                $user->otp_code = $otpCode;
                $user->save();

                // Lưu thời gian hết hạn OTP vào session hoặc cache
                $expiresAt = now()->addMinutes(1);
                Cache::put('otp_expires_at_' . $user->user_id, $expiresAt, 60);
                session(['otp_expires_at' => $expiresAt->timestamp]);

                // Gửi OTP mới qua email
                // Gửi mail thông qua queue
                Mail::to($user->user_email)->queue(new OtpMail($user->user_name, $otpCode));

                $messageSuccess = 'Đã gửi thành công mã OTP về email';
                return redirect()->route('verify-mail')->with('success', $messageSuccess);
            } else {
                // Nếu OTP chưa hết hạn, chuyển hướng người dùng tới trang xác thực với thông báo
                $messageInfo = 'Mã OTP vẫn còn hiệu lực, vui lòng kiểm tra email.';
                return redirect()->route('verify-mail')->with('success', $messageInfo);
            }
        } else {
            return redirect()->intended('/');
        }

        return back()->with('login_error', $errorMessage);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
        ]);

        $user = UserMixue::where('user_email', $request->input('user_email'))->first();

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy người dùng.'], 404);
        } else {
            session(['user_email' => $user->user_email]);

            $currentTimestamp = now()->timestamp;
            $otpExpiresAt = session('otp_expires_at', 0);

            if ($currentTimestamp > $otpExpiresAt) {
                // Sinh OTP ngẫu nhiên
                $otpCode = rand(100000, 999999);

                // Lưu OTP vào database
                $user->otp_code = $otpCode;
                $user->save();

                // Lưu thời gian hết hạn OTP vào session hoặc cache
                $expiresAt = now()->addMinutes(1);
                Cache::put('otp_expires_at_' . $user->user_id, $expiresAt, 60);
                session(['otp_expires_at' => $expiresAt->timestamp]);

                // Gửi OTP mới qua email
                // Gửi mail thông qua queue
                Mail::to($user->user_email)->queue(new OtpMail($user->user_name, $otpCode));

                $messageSuccess = 'Đã gửi thành công mã OTP về email';
                return redirect()->route('forgotpwd-verify-mail')->with('success', $messageSuccess);
            } else {
                // Nếu OTP chưa hết hạn, chuyển hướng người dùng tới trang xác thực với thông báo
                $messageInfo = 'Mã OTP vẫn còn hiệu lực, vui lòng kiểm tra email.';
                return redirect()->route('forgotpwd-verify-mail')->with('success', $messageInfo);
            }
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|integer',
        ]);

        $user = UserMixue::where('otp_code', $request->input('otp'))->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Mã OTP không chính xác.']);
        }

        // Nếu OTP chính xác, chuyển hướng người dùng đến trang reset mật khẩu
        $redirectUrl = route('reset-password');
        return response()->json(['success' => 'OTP chính xác.', 'redirectUrl' => $redirectUrl]);
    }

    public function changePassword(Request $request)
    {
        // Kiểm tra xem người dùng có đến từ trang forgot-password không
        if (!session()->has('user_email')) {
            return redirect()->route('forgot-password')->with('error', 'Không thể đặt lại mật khẩu. Vui lòng thử lại.');
        }

        // Lấy email người dùng từ session
        $user_email = session()->get('user_email');
//        Log::log('info', 'Email người dùng: ' . $user_email);

        // Tìm người dùng tương ứng
        $user = UserMixue::where('user_email', $user_email)->first();

        // Kiểm tra xem mật khẩu và mật khẩu xác nhận có khớp nhau không
        $user_password = $request->input('user_password');
        $user_repassword = $request->input('user_repassword');
        if ($user_password !== $user_repassword) {
            return back()->withErrors(['user_password' => 'Mật khẩu và mật khẩu xác nhận không khớp.']);
        }

        // Cập nhật mật khẩu người dùng
        $user->user_password = Hash::make($user_password);
        $user->save();

        // Xóa email người dùng khỏi session
        session()->forget('user_email');

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công.');
    }

    public function updateStatus(Request $request, $userId)
    {
        $user_status = $request->input('user_status') == 'true' ? 1 : 0;
        DB::table('User')->where('user_id', $userId)->update(['user_status' => $user_status]);
        return response()->json(['success' => 'Trạng thái cập nhật thành công']);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'user_password' => 'required',
            'user_status' => 'required',
        ]);

        // Kiểm tra xem email đã tồn tại chưa
        $emailExists = DB::table('User')->where('user_email', $request->input('user_email'))->exists();

        if ($emailExists) {
            return response()->json(['error' => 'Email đã tồn tại trong hệ thống.'], 409);
        }

        $uuid = Uuid::uuid4()->toString();

        DB::table('User')->insert([
            'user_id' => $uuid,
            'user_email' => $request->input('user_email'),
            'user_password' => Hash::make($request->input('user_password')),
            'user_name' => $request->input('user_name'),
            'user_status' => $request->input('user_status') ? 1 : 0,
            'verified' => 1,
            'user_address' => null,
            'user_gender' => 'male',
            'role_id' => 1,
        ]);

        // $newUserId = DB::getPdo()->lastInsertId();
        // $newUser = DB::table('User')->where('user_id', $newUserId)->first();
        $newUser = DB::table('User')->where('user_id', $uuid)->first();

        $countUser = DB::table('User')->count();
        return view('admin.user.list', compact('newUser', 'countUser'));
        // return response()->json(['success' => 'Tài khoản người dùng đã được thêm.', 'user' => $newUser]);
    }
}
