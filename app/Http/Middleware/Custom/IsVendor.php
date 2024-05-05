<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role === 'Vendor'){
            return $next($request);
        }
        else{
            $user = Auth::user();
            return match ($user->role) {
                'Delivery Man' => redirect('/me/dashboard'),
                default => redirect('/'),
            };
        }
    }
}
