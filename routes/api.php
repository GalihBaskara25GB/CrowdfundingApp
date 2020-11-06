<?php

// use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Auth')->group(function() {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::post('logout', 'LogoutController');
});

Route::namespace('Articles')->middleware('auth:api')->group(function() {
    Route::post('create-new-article', 'ArticleController@store');
    Route::patch('update-selected-article/{article}', 'ArticleController@update');
    Route::delete('delete-selected-article/{article}', 'ArticleController@destroy');
});

Route::get('articles/{article}', 'Articles\ArticleController@show');
Route::get('articles', 'Articles\ArticleController@index');

Route::get('user', 'UserController');
