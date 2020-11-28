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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function() {

    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::post('logout', 'LogoutController')->middleware('auth:api');
    Route::post('verification', 'VerificationController');
    Route::post('regenerate-otp', 'RegenerateOtpController');
    Route::post('update-password', 'UpdatePasswordController');
    Route::post('check-token', 'CheckTokenController')->middleware('auth:api');

    Route::get('/social/{provider}', 'SocialiteController@redirectToProvider');
    Route::get('/social/{provider}/callback', 'SocialiteController@handleProviderCallback');

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
        Route::get('/', 'CampaignController@index');
        Route::get('random/{count}', 'CampaignController@random');
        Route::get('/{id}', 'CampaignController@show');
        Route::get('/search/{keyword}', 'CampaignController@search');
        Route::post('store', 'CampaignController@store');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog'
],function() {
    Route::get('/', 'BlogController@index');
    Route::get('random/{count}', 'BlogController@random');
    Route::get('/{id}', 'BlogController@show');
    Route::get('/search/{keyword}', 'BlogController@search');
    Route::post('store', 'BlogController@store');
});

Route::get('articles/{article}', 'Articles\ArticleController@show');
Route::get('articles', 'Articles\ArticleController@index');

Route::get('user', 'UserController');
