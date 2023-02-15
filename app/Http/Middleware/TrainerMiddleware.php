<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class TrainerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda belum memiliki session aktif. Silakan login terlebih dahulu');
        }
        if ($request->user()->level != 'trainer') {
            if ($request->user()->level == 'member') {
                return redirect()->intended(RouteServiceProvider::MEMBER)->with('error', 'Unauthorize');
            } elseif ($request->user()->level == 'admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN)->with('error', 'Unauthorize');
            } else {
                abort(500, 'Something went worng!');
            }
        }
        return $next($request);
    }
}
