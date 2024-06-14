<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckCartContent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $restaurantId = session('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);
        if (!$restaurant) {
            abort(403);
        }
        $timezone = new \DateTimeZone('Asia/Ho_Chi_Minh');
        $openTime = new \DateTime($restaurant->restaurant_openTime, $timezone);
        $closeTime = new \DateTime($restaurant->restaurant_closeTime, $timezone);
        $now = new \DateTime('now', $timezone);

        if (!Auth::check()) {
            $errorMessage = 'Vui lòng đăng nhập trước khi mua hàng.';
        } else if (Cart::count() < 2) {
            $errorMessage = 'Bạn cần ít nhất 2 sản phẩm trong giỏ hàng.';
        } else if (!Auth::user()->verified == 1 || !Auth::user()->user_status == 1) {
            $errorMessage = 'Bạn không có quyền truy cập vào trang này.';
        } else if ($now < $openTime || $now > $closeTime || $restaurant->restaurant_openStatus == 0) {
            $errorMessage = 'Nhà hàng hiện không mở cửa.';
        } else {
            return $next($request);
        }

        return redirect('/')->with('login_error', $errorMessage);
    }
}
