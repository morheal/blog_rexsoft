<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Response;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
      $name = $request->name;
      $new_category = Category::create(['name' => $name]);
      return Response::json($new_category);
    }

    public function deleteCategory(Request $request)
    {
      Category::deleteById($request->id);
      return Response::json($request->id);
    }

    public function findCategory($id)
    {
      $this_category = Category::find($id);
      $articles = $this_category->articles;
      return view('categories.category', ['category' => $this_category, 'articles' => $articles]);
    }
}
