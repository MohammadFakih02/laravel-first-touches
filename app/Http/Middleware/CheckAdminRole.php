<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CheckAdminRole
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
        try {
            // Authenticate the user using the JWT token
            $user = JWTAuth::parseToken()->authenticate();

            // Check if the user has the admin role
            if ($user->role !== 'admin') {
                return response()->json(['error' => 'Access denied: Admins only'], 403);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token error: ' . $e->getMessage()], 401);
        }

        // Allow the request to proceed if the user is an admin
        return $next($request);
    }
}
