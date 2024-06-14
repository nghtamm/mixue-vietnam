<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class HorizonAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có role_id là 3 không
        if (!Auth::check() || Auth::user()->role_id != 3) {
            // Nếu không đáp ứng điều kiện, trả về mã lỗi 403
            abort(403);
        }

        return $next($request);
    }
}
