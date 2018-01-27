<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;
use App\Category;
use Mail;
use App\User;
use App\Mail\ArticlePosted;

class Article extends Model
{
    protected $fillable = ['title', 'text', 'creator', 'category_id'];

    //RELATIONSHIPS FUNCTIONS
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function feedbacks()
    {
      return $this->hasMany('App\Feedback');
    }
    //////////////////////////

    public static function deleteById($id)
    {
      Article::find($id)->delete();
      return;
    }

    public function sendNotification()
    {
      $users = User::where('subscribe', true)->get();
      foreach ($users as $user) {
        Mail::to($user->email)->send(new ArticlePosted($this));
      }
    }
}
