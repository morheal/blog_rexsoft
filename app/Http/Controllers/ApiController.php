<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use App\Category;

class ApiController extends Controller
{
    public function allArticles(Request $request)
    {
      return Articles::get();
    }

    public function articlesByCategory($id)
    {
      return Category::find($id)->articles;
    }

    public function addArticle(Request $request)
    {
      return Article::create($request->all);
    }

    public function deleteArticle($id)
    {
      Article::deleteById($id);
      return 204;
    }
}
