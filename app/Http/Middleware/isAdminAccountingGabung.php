<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdminAccountingGabung
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasRole('Aplikasi Accounting') || Auth::user()->role == 'owner') {
            return $next($request);
        }
        abort(403);
    }
}