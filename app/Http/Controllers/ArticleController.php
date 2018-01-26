<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Article;
use App\Category;
use Auth;

class ArticleController extends Controller
{
    public function addArticle(Request $request)
    {
      $title = $request->title;
      $text = $request->text;
      $category = $request->category;
      $new_article = Article::create(['title' => $title, 'text' => $text, 'creator' => Auth::user()->id, 'category_id' => $category]);
      $article_category = Category::find($category);
      return Response::json(['article' => $new_article, 'category_name' => $article_category->name]);
    }

    public function deleteArticle(Request $request)
    {
      Article::deleteById($request->id);
      return Response::json($request->id);
    }
}
