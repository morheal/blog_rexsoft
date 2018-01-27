<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Feedback;
use App\Article;

class Feedback extends Model
{
    protected $fillable = ['user_id', 'article_id', 'text'];

    //RELATIONSHIPS FUNCTIONS
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function article()
    {
      return $this->belongsTo('App\Article');
    }
    /////////////////////////

    public static function deleteById($id)
    {
      Feedback::find($id)->delete();
      return;
    }
}
