<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->level == 'admin') {
                    return redirect()->intended(RouteServiceProvider::ADMIN)->with('error', 'Anda sedang login sebagai admin! Harap log out terlebih dahulu');
                }
                elseif (Auth::user()->level == 'trainer') {
                    return redirect()->intended(RouteServiceProvider::TRAINER)->with('error', 'Anda sedang login sebagai trainer! Harap log out terlebih dahulu');
                }
                elseif (Auth::user()->level == 'member') {
                    return redirect()->intended(RouteServiceProvider::MEMBER)->with('error', 'Anda sedang login sebagai member! Harap log out terlebih dahulu');
                }
                else {
                    abort(500, 'Something went wrong');
                }
            }
        }

        return $next($request);
    }
}