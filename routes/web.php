<?php

use Illuminate\Support\Facades\Route;

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

// welcome page 
Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Articles Routes.

    // listing all articles
    Route::get('/articles', 'ArticleController@index');
    // listing all user articles
    Route::get('/myarticles', 'ArticleController@myArticles');
    // showing a view to create new article
    Route::get('/articles/create', 'ArticleController@create');
    // persist an article to DB
    Route::post('/articles', 'ArticleController@store');
    // showing a view to edit an existing article
    Route::get('/articles/{article}/edit', 'ArticleController@edit');
    // persist updates for a specific article
    Route::put('/articles/{article}', 'ArticleController@update');
    // delete article
    Route::delete('/articles/{article}', 'ArticleController@destroy');
    // Route::delete('/articles', 'ArticleController@destroy'); // to be checked later

    // showing a specific article, note: moved to the bottom to avoid routes collision, due to using a wildcard
    Route::get('/articles/{article}', 'ArticleController@show');

    // comments section

    Route::post('comment', 'CommentController@store');

    Route::delete('comment/{comment}', 'CommentController@destroy');
    //likes section 
    Route::post('like', 'LikeController@store');
});
