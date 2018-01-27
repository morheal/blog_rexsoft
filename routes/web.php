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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', 'HomeController@categories');

//ARTICLE CONTROLLER ROUTES
Route::get('/article/{id}', 'ArticleController@articleShow');
Route::post('/add_article', 'ArticleController@addArticle');
Route::post('/delete_article', 'ArticleController@deleteArticle');
Route::post('/delete_article_redirect', 'ArticleController@deleteArticleRedirect');

//CATEGORY CONTROLLER ROUTES
Route::post('/add_category', 'CategoryController@addCategory');
Route::post('/delete_category', 'CategoryController@deleteCategory');
Route::get('/category/{id}', 'CategoryController@findCategory');

//FEEDBACK CONTROLLER ROUTES
Route::post('/add_feedback', 'FeedbackController@addFeedback');
Route::post('/delete_feedback', 'FeedbackController@deleteFeedback');
Route::post('/subscribe', 'UserController@subscribe');
Route::post('/unsubscribe', 'UserController@unsubscribe');
