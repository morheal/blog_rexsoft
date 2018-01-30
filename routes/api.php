<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all_articles', 'ApiController@allArticles');
Route::get('/category/{id}', 'ApiController@articlesByCategory');
Route::post('/add_article', 'ApiController@addArticle');
Route::delete('/delete_article/{id}'. 'ApiController@deleteArticle');
