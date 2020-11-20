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
    Route::post('auth/register', 'RegisterController');
    Route::post('auth/login', 'LoginController');
    Route::post('auth/logout', 'LogoutController');
    Route::post('auth/verification', 'VerificationController');
    Route::post('auth/regenerate-otp', 'RegenerateOtpController');
    Route::post('auth/update-password', 'UpdatePasswordController');
});

Route::namespace('Articles')->middleware('auth:api')->group(function() {
    Route::post('create-new-article', 'ArticleController@store');
    Route::patch('update-selected-article/{article}', 'ArticleController@update');
    Route::delete('delete-selected-article/{article}', 'ArticleController@destroy');
});

Route::namespace('Profile')->middleware('auth:api')->group(function() {
    Route::post('profile/update-profile', 'ProfileController@update');
    Route::get('profile/get-profile', 'ProfileController@show');
});

Route::group([
        'middleware' => 'api',
        'prefix' => 'campaign'
    ],function() {
        Route::get('random/{count}', 'CampaignController@random');
        Route::post('store', 'CampaignController@store');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog'
],function() {
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});

Route::get('articles/{article}', 'Articles\ArticleController@show');
Route::get('articles', 'Articles\ArticleController@index');

Route::get('user', 'UserController');
