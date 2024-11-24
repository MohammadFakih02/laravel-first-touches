<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->attributes->get('authenticated_user');

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Access denied: Admins only'], 403);
        }

        return $next($request);
    }
}
