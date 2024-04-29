<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        if (auth()->check() && auth()->user()->role_id === 2) {

            return $next($request);
        } else {
            return response()->json([
                'status code' => 403, 
                'message' => "Sorry, vous n'êtes pas autorisé à accéder à cette ressource réservé aux utilisateurs de ce système."
            ], 403);
        }
    }
}
