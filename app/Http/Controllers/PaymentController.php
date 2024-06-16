<?php

namespace App\Http\Controllers;

use App\Jobs\CancelUnacceptedOrder;
use App\Models\DailyOrderCount;
use App\Models\IceOption;
use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Restaurant;
use App\Models\Shipping;
use App\Models\SugarOption;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    /**
     *
     * Trang chủ
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $data['user'] = $user;
        return view('payment.main', $data);
    }

    /**
     *
     * Gửi đơn lên database và gửi đơn telegram.
     */
    public function processCheckout(Request $request)
    {
        // $restaurantId = $request->input('restaurant_id');
        $restaurantId = session('restaurant_id');
        // dd($restaurantId);
        $message_shop = $request->input('message_shop');
        $specific_time = $request->input('specific_time');
        $delivery_time = $request->input('delivery_time');
        $order_payment = $request->input('order_payment');
        $order_gift = $request->input('isGift') == 'true' ? 1 : 0;
        if ($order_gift) {
            $validatedData = $request->validate([
                'recipient_name' => 'bail|required|regex:/^[\pL\s]+$/u',
                'recipient_phone' => 'bail|required|digits:10|starts_with:0',
                'recipient_address' => 'bail|required|string|max:255',
            ]);
        } else {
            $validatedData = $request->validate([
                'user_name' => 'bail|required|regex:/^[\pL\s]+$/u',
                'user_phone' => 'required|digits:10|starts_with:0',
                'user_address' => 'bail|required|string|max:255',
            ]);
        }



        // dd($order_gift);
        // dd($message_shop, $delivery_time, $specific_time);
        $shippingFee = session('shipping_fee');
        $shipping_id = Shipping::where('shipping_fee', $shippingFee)->value('shipping_id');
        $order = new Orders();
        $order->save();

        // Lấy ngày hiện tại
        $date = now()->toDateString();

        // Kiểm tra và cập nhật bản ghi trong bảng DailyOrderCount
        $dailyOrderCount = DailyOrderCount::firstOrNew([
            'restaurant_id' => $restaurantId,
            'date' => $date,
        ]);

        $dailyOrderCount->order_count = ($dailyOrderCount->order_count ?? 0) + 1;
        $dailyOrderCount->save();
        foreach (Cart::content() as $item) {
            $orderItem = new OrderDetail();
            $sugarId = SugarOption::where('sugar_option', $item->options->sugar)->value('sugar_id');
            $iceId = IceOption::where('ice_option', $item->options->ice)->value('ice_id');
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->quantity = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->product_total = $item->qty * $item->price;
            $orderItem->sugar_id = $sugarId;
            $orderItem->ice_id = $iceId;
            $orderItem->save();
        }
        $order->user_id = Auth::id();
        $order->total_price = Cart::subtotal() + $shippingFee;
        $order->bill_status = 'Đang chờ xử lí';
        $order->payment_status = 'Đang chờ thanh toán';
        $order->user_note = $message_shop;
        $order->shipping_id = $shipping_id;
        $order->restaurant_id = $restaurantId;
        $order->is_asap = $delivery_time;
        $order->scheduled_delivery_time = $specific_time;
        if ($order_gift) {
            $order->order_name = $validatedData['recipient_name'];
            $order->order_phone = $validatedData['recipient_phone'];
            $order->order_address = $validatedData['recipient_address'];
        } else {
            $order->order_name = $validatedData['user_name'];
            $order->order_phone = $validatedData['user_phone'];
            $order->order_address = $validatedData['user_address'];
        }
        $order->order_gift = $order_gift;
        $order->order_payment = $order_payment;
        $order->quantity = Cart::count();
        $order->daily_order_number = $dailyOrderCount->order_count;
        $order->save();

        if ($order_payment == '1') {
            $vnp_Url = $this->createPayment($order);
            return response()->json(['vnp_Url' => $vnp_Url]);
        }

        // Lấy tgroup_id từ bảng restaurant dựa vào restaurantId
        $chatId = Restaurant::where('restaurant_id', $restaurantId)->value('tgroup_id');
        // Kiểm tra nếu chatId tồn tại
        if ($chatId) {
            $order->load('orderDetails');
            Notification::route('telegram', $chatId)
                ->notify(new OrderNotification($order, $chatId));
            // Gửi job vào hàng đợi với độ trễ 10 phút
            CancelUnacceptedOrder::dispatch($order->id)->delay(now()->addMinutes(10));
            Log::channel('slack')->info("Bạn có 1 đơn hàng mới");
            // dd($order, $chatId);
        }

        // dd(Cart::content());
        // dd($order, $chatId, $restaurantId);
        Cart::destroy();
        return response()->json(['redirectURL' => route('thankyou')]);
    }

    public function createPayment($order) {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('returnPayment');
        $vnp_TmnCode = config('services.vnpay.tmncode');
        $vnp_HashSecret = config('services.vnpay.hashsecret');
        Log::info('VNPAY_TMNCODE: ' . $vnp_TmnCode);
        Log::info('VNPAY_HASHSECRET: ' . $vnp_HashSecret);
        $vnp_TxnRef = $order->id;
        $vnp_OrderInfo = 'Thanh toán dịch vụ tại Mixue';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $order->total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'VNBANK';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_IpAddr" => $vnp_IpAddr
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function returnPayment(Request $request) {
        $vnp_HashSecret = config('services.vnpay.hashsecret');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($request->input('vnp_ResponseCode') == '00') {
                // Xử lý đơn hàng, cập nhật trạng thái thanh toán
                $orderId = $request->input('vnp_TxnRef');
                $order = Orders::find($orderId);
                $restaurantId = $order->restaurant_id;
                $order->payment_status = 'Đã thanh toán';
                $order->save();

                // Lấy tgroup_id từ bảng restaurant dựa vào restaurantId
                $chatId = Restaurant::where('restaurant_id', $restaurantId)->value('tgroup_id');
                // Kiểm tra nếu chatId tồn tại
                if ($chatId) {
                    $order->load('orderDetails');
                    Notification::route('telegram', $chatId)
                        ->notify(new OrderNotification($order, $chatId));
                    // Gửi job vào hàng đợi với độ trễ 10 phút
                    CancelUnacceptedOrder::dispatch($order->id)->delay(now()->addMinutes(10));
                    Log::channel('slack')->info("Bạn có 1 đơn hàng mới");
                }

                Cart::destroy();
                return redirect()->route('thankyou');
            } else {
                $orderId = $request->input('vnp_TxnRef');
                $order = Orders::find($orderId);
                $order->bill_status = 'Hủy đơn hàng';
                $order->save();

                Cart::destroy();
                return redirect('/');
            }
        } else {
            $returnData['vnp_ResponseCode'] = '97';
            $returnData['vnp_Message'] = 'Chữ ký không hợp lệ';
            return response()->json($returnData);
        }
    }

    /**
     *
     * Main tính toán phí giao hàng
     */
    public function calculateDistance(Request $request)
    {
        // $restaurantId = $request->input('restaurantId');
        $restaurantId = session('restaurant_id');
        // dd($restaurantId);
        $restaurant = Restaurant::find($restaurantId);
        if (!$restaurant) {
            return response()->json(['error' => 'Nhà hàng không được tìm thấy.'], 404);
        }

        $user = Auth::user();
        $order_gift = $request->input('isGift') == 'true';

        // Lấy địa chỉ giao hàng dựa trên lựa chọn của người dùng
        $deliveryAddress = $order_gift ? $request->input('recipient_address') : $user->user_address;

        // Tính phí giao hàng
        $shippingFee = $this->getShippingFee($deliveryAddress, $restaurant->restaurant_location);

        // Lưu phí giao hàng vào session để tái sử dụng
        session(['shipping_fee' => $shippingFee]);

        return response()->json(['shipping_fee' => $shippingFee]);
    }


    /**
     * Tính toán và lưu trữ phí giao hàng.
     *
     * @param string $userAddress Địa chỉ của người dùng
     * @param string $restaurantAddress Địa chỉ nhà hàng
     * @return mixed
     */
    private function getShippingFee($userAddress, $restaurantAddress)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => [
                'origins' => $userAddress,
                'destinations' => $restaurantAddress,
                'key' => env('GOOGLE_MAPS_API_KEY')
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        if (isset($data['rows'][0]['elements'][0]['distance']['text'])) {
            $distanceText = $data['rows'][0]['elements'][0]['distance']['text'];
            // Xử lý khoảng cách được trả về dưới dạng km hoặc m
            if (strpos($distanceText, ' km') !== false) {
                $distanceValue = (float) str_replace(' km', '', $distanceText);
            } elseif (strpos($distanceText, ' m') !== false) {
                $distanceValue = (float) str_replace(' m', '', $distanceText) / 1000; // Chuyển đổi m sang km
            } else {
                $distanceValue = 0; // Giá trị mặc định nếu không xác định được
            }

            $shippingFee = $distanceValue > 10 ? 200000 : Shipping::where('min_distance', '<=', $distanceValue)
                ->where('max_distance', '>', $distanceValue)
                ->value('shipping_fee');
        } else {
            $shippingFee = null;
        }

        Session::put('shipping_fee', $shippingFee);
        // dd($distanceValue, $shippingFee);

        return $shippingFee;
    }


    /**
     *
     * Kiểm tra thời gian mở cửa, đóng cửa của cửa hàng
     */
    public function checkRestaurantTime(Request $request)
    {
        // $restaurantId = $request->input('restaurant_id');
        $restaurantId = session('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);
        // dd($restaurantId, $restaurant);
        if ($restaurant) {
            return response()->json([
                'openTime' => $restaurant->restaurant_openTime,
                'closeTime' => $restaurant->restaurant_closeTime
            ]);
        } else {
            return response()->json(['error' => 'Restaurant not found'], 404);
        }
    }

    /**
     *
     * Validate input
     */
    public function validateInput(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'bail|required|regex:/^[\pL\s]+$/u',
            'email' => 'bail|required|email|ends_with:@gmail.com',
            'phone' => 'bail|required|digits:10|starts_with:0',
            // 'address' => 'required',
        ]);

        return response()->json(['success' => 'Dữ liệu hợp lệ.']);
    }

    public function getRestaurantId(Request $request)
    {
        // dd(session('restaurant_id'));
        // $restaurantId = session('restaurant_id');
        return response()->json([
            'restaurantId' => session('restaurant_id'),
        ]);
    }
}
