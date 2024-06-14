<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSystem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            $errorMessage = 'Vui lòng đăng nhập trước khi mua hàng.';
        } else if (Auth::user()->role_id == 1) {
            $errorMessage = 'Bạn đang cố gắng truy cập vào trang không có quyền quản trị.';
        } else if (!Auth::user()->verified == 1 || !Auth::user()->user_status == 1) {
            $errorMessage = 'Bạn không có quyền truy cập vào trang này.';
            return redirect('home')->with('login_error', $errorMessage);
        } else {
            return $next($request);
        }

        return redirect('login')->with('login_error', $errorMessage);
    }
}
