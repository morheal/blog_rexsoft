<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Article;
use App\Category;
use App\Feedback;
use Auth;

class ArticleController extends Controller
{
    public function addArticle(Request $request)
    {
      $title = $request->title;
      $text = $request->text;
      $category = $request->category;
      $new_article = Article::create(['title' => $title, 'text' => $text, 'user_id' => Auth::user()->id, 'category_id' => $category]);
      $article_category = Category::find($category);
      $new_article->sendNotification();
      return Response::json(['article' => $new_article, 'category_name' => $article_category->name]);
    }

    public function deleteArticle(Request $request)
    {
      Article::deleteById($request->id);
      return Response::json($request->id);
    }

    public function deleteArticleRedirect($id)
    {
      Article::deleteById($request->id);
      return Redirect::back();
    }

    public function articleShow($id)
    {
      $this_article = Article::find($id);
      return view('article', ['article' => $this_article]);
    }
}
