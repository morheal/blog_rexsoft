<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;
use App\Category;

class Article extends Model
{
    protected $fillable = ['title', 'text', 'creator', 'category_id'];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public static function deleteById($id)
    {
      Article::find($id)->delete();
      return;
    }
}
