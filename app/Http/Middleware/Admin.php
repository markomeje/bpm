<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Models\User;
use Closure;

class Admin
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
        $roles = User::where('role', '!=', 'user')->pluck('role')->toArray();
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
