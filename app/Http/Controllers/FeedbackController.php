<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use Response;
use Auth;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
      $text = $request->text;
      $article_id = $request->article_id;
      $new_feedback = Feedback::create(['text' => $text, 'article_id' => $article_id, 'user_id' => Auth::user()->id]);
      $user_name = Auth::user()->name;
      return Response::json(['feedback' => $new_feedback, 'name' => $user_name]);
    }

    public function deleteFeedback(Request $request)
    {
      Feedback::deleteById($request->id);
      return Response::json($request->id);
    }
}
