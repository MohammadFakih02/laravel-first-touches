<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class AdminController extends Controller
{
    public function get_Articles(Request $request){
        $articles = Article::all();

        return response()->json(["article"=>$articles],200);
    }

    public function create_Article(Request $request){
        $article = Article::create([
            "name" => $request->name,
            "content"=> $request->content,
            "age_rating"=> $request->age_rating,
        ]);
        return response()->json(["new_article"=>$article],200);
    }

    public function update_Article($id,Request $request){
        $article = Article::find($id)->update([
            "name" => $request->name,
            "content" => $request->code,
            "age_rating"=> $request->age_rating,
        ]);
        return response()->json([
            "updated_article" => $article
        ],200);
    }

    public function delete_Article($id){
        $article = Article::find($id)->delete();
        return response()->json(["Deleted article"=>$article],200);
    }

}
