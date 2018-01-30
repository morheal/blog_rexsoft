<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AdminController extends Controller
{
    public function showUsers()
    {
      $users = User::where('is_admin', false)->paginate(15);
      return view('users.users', ['users' => $users]);
    }
}
