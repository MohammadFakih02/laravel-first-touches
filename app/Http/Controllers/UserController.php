<?php

namespace App\Http\Controllers;

use App\Models\UserArticle;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_Articles(Request $request){
        $articles = UserArticle::all();

        return response()->json(["article"=>$articles],200);
    }

    public function create_Article(Request $request){
        $article = UserArticle::create([
            "name" => $request->name,
            "content"=> $request->content,
            "age_rating"=> $request->age_rating,
            "article_id"=> $request->article_id,
        ]);
        return response()->json(["new_article"=>$article],200);
    }

    public function update_Article($id,Request $request){
        $article = UserArticle::find($id)->update([
            "name" => $request->name,
            "content" => $request->code,
            "age_rating"=> $request->age_rating,
            "article_id"=> $request->article_id,
        ]);
        return response()->json([
            "updated_article" => $article
        ],200);
    }
}
