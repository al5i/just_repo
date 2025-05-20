<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->role == 1 && !$request->is('admin*')) {
                return redirect()->route('admin_main');
            } elseif (auth()->user()->role != 1 && !$request->is('blog*')) {
                return redirect()->route('blog');
            }
        }
        return $next($request);
    }
}
