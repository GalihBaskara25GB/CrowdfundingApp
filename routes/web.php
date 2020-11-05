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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verifyEmail'])->group(function () {
    Route::get('/route1', 'DashboardController@route1');
});


Route::middleware(['auth', 'verifyEmail', 'verifyAdmin'])->group(function () {
    Route::get('/route2', 'DashboardController@route2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
