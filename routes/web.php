<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categories', 'HomeController@categories');

//ARTICLE CONTROLLER ROUTES
Route::post('/add_article', 'ArticleController@addArticle');
Route::post('/delete_article', 'ArticleController@deleteArticle');

//CATEGORY CONTROLLER ROUTES
Route::post('/add_category', 'CategoryController@addCategory');
Route::post('/delete_category', 'CategoryController@deleteCategory');
Route::get('/category/{id}', 'CategoryController@findCategory');
