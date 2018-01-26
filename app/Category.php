<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Article;

class Category extends Model
{
    protected $fillable = ['name'];

    public function articles()
    {
      return $this->hasMany('App\Article');
    }

    public static function deleteById($id)
    {
      Category::find($id)->delete();
      return;
    }
}
