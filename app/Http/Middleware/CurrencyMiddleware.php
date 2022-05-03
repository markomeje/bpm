<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if (!$request->get('currency') && !$request->getSession()->get('currency')) {
            $clientIP = $request->getClientIp();
            $localCurrency = geoip($clientIP)->getAttribute('currency');
            $request->getSession()->put([
                'currency' => $localCurrency,
            ]);
        }
        return $next($request);
    }
}
