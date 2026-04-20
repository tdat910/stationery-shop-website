<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;
        $requiredRole = $role === 'admin' ? 1 : 0;

        if ($userRole != $requiredRole) {
            if ($role === 'admin') {
                return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang này.');
            } else {
                return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
            }
        }

        return $next($request);
    }
}
