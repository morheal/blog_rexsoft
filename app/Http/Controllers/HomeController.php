<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $categories_data = [];
        foreach ($categories as $category) {
          array_push($categories_data, [$category->id => $category->name]);
        }
        $articles = Article::paginate(5);
        return view('home', ['articles' => $articles, 'categories' => $categories_data]);
    }

    public function categories()
    {
        $categories = Category::paginate(10);
        return view('categories.categories', ['categories' => $categories]);
    }
}
