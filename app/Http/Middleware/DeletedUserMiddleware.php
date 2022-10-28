<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class DeletedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if('deleted' !== auth()->user()->status){
            return $next($request);
        }

        auth()->logout();
        return redirect()->route('login');
    }
}
