<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrainerHasAccountMiddleware
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
        if ($request->user()->trainer != null) {
            return redirect()->route('trainer.profile.index')->with('warning', 'Anda sudah memiliki akun!');
        }
        return $next($request);
    }
}
