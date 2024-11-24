<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Article; // Import the Article model
use Tymon\JWTAuth\Facades\JWTAuth;

class AgeCheck
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $articleId = $request->route('id');
            $article = Article::find($articleId);

            if (!$article) {
                return response()->json(['error' => 'Article not found'], 404);
            }

            if ($user->age < $article->age_rating) {
                return response()->json(['error' => 'You are not allowed to access this article due to age restrictions'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token not valid or user authentication failed'], 401);
        }

        return $next($request);
    }
}
