<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    protected $fillable = [
        'name',
        'content',
        'age_rating',
        'article_id',
    ];
}
