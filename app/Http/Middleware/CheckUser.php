<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
//            Log::info('Unauthorized access attempt', ['user' => Auth::user(), 'url' => $request->url()]);
            // Nếu không đáp ứng điều kiện, trả về mã lỗi 403
            abort(403);
        }

        return $next($request);
    }
}
