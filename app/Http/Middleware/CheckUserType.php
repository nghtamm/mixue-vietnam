<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
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
            // return $next($request);
        } else if (Auth::user()->verified == 0 || !Auth::user()->user_status == 1) {
            $errorMessage = 'Bạn không có quyền truy cập vào trang này.';
        } else {
            return $next($request);
        }

        return redirect('login')->with('login_error', $errorMessage);
    }
}
