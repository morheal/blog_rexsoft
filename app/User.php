<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'subscribe', 'is_admin', 'is_banned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //RELATIONSHIPS FUNCTIONS
    public function articles()
    {
      return $this->hasMany('App\Article');
    }

    public function feedbacks()
    {
      return $this->hasMany('App\Feedback');
    }
    ///////////////////////////

    //Subcribing/unsubscribing from mail sending for user
    public function subscribe()
    {
      $this->subscribe = true;
      $this->save();
      return;
    }

    public function unsubscribe()
    {
      $this->subscribe = false;
      $this->save();
      return;
    }
    /////////////////////////////////////////////////////////////
}
