<?php

namespace App\Http\Controllers;

use App\Models\UserMixue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Rules\Turnstile;

class RegisterController extends Controller
{
    public function addUser(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|regex:/^[\pL\s]+$/u',
            'user_phone' => 'required|digits:10|starts_with:0',
            'user_address' => 'required|string|max:255',
            'user_email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'user_password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).*$/',
            ],
            'user_gender' => 'required|in:male,female',
            // 'cf-turnstile-response' => ['required', new Turnstile()],
        ], [
            'user_name.required' => 'Tên là trường bắt buộc.',
            'user_name.regex' => 'Họ và tên của bạn không được nhập số.',
            'user_phone.required' => 'Số điện thoại là trường bắt buộc.',
            'user_phone.digits' => 'Số điện thoại phải có 10 chữ số.',
            'user_phone.starts_with' => 'Số điện thoại phải bắt đầu bằng số 0.',
            'user_address.required' => 'Địa chỉ là trường bắt buộc.',
            'user_address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'user_address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'user_email.required' => 'Email là trường bắt buộc.',
            'user_email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'user_email.regex' => 'Email phải kết thúc bằng @gmail.com.',
            'user_gender.required' => 'Giới tính là trường bắt buộc.',
            'user_password.required' => 'Mật khẩu là trường bắt buộc.',
            'user_password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'user_password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái thường, một chữ cái hoa, một số và một ký tự đặc biệt.',
            'user_gender.in' => 'Giới tính không hợp lệ.',
        ]);

        // Kiểm tra xem email đã tồn tại chưa
        $emailExists = DB::table('User')->where('user_email', $validatedData['user_email'])->exists();

        if ($emailExists) {
            return back()->withErrors(['email' => 'Email đã tồn tại trong hệ thống.'])->withInput();
        }
        // Tạo người dùng mới
        $uuid = Uuid::uuid4()->toString();

        $user = new UserMixue();
        $user->user_id = $uuid;
        $user->user_name = $validatedData['user_name'];
        $user->user_email = $validatedData['user_email'];
        $user->user_phone = $validatedData['user_phone'];
        $user->user_address = $validatedData['user_address'];
        $user->user_gender = $validatedData['user_gender'];
        $user->user_password = Hash::make($validatedData['user_password']);
        $user->verified = 0;
        $user->role_id = 1;
        $user->user_status = 1;

        $user->save();
        // dd($user);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập.');
    }
}
