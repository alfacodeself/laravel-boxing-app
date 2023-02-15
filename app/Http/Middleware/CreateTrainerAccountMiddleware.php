<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CreateTrainerAccountMiddleware
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
        if ($request->user()->trainer == null) {
            return redirect()->route('trainer.profile.create')->with('warning', 'Harap lengkapi data diri anda terlebih dahulu!');
        }
        return $next($request);
    }
}
