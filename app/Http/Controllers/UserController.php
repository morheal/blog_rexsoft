<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;

class UserController extends Controller
{
    public function subscribe()
    {
      $user = Auth::user();
      $user->subscribe = true;
      $user->save();
      return Response::json(true);
    }

    public function unsubscribe()
    {
      $user = Auth::user();
      $user->subscribe = false;
      $user->save();
      return Response::json(true);
    }
}
