<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserArticle;

class AgeCheck
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->attributes->get('authenticated_user');

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if ($request->route('id')) {
            $articleId = $request->route('id');
            $article = UserArticle::find($articleId);

            if (!$article) {
                return response()->json(['error' => 'Article not found'], 404);
            }

            if ($user->age < $article->age_rating) {
                return response()->json(['error' => 'You are not allowed to access this article due to age restrictions'], 403);
            }

            $request->attributes->set('article', $article);
        } else {
            $allowedArticles = UserArticle::where('age_rating', '<=', $user->age)->get();
            $request->attributes->set('articles', $allowedArticles);
        }

        return $next($request);
    }
}
