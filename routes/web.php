<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect(Settings::get('startPage'));
})->middleware(['isBanned']);

Auth::routes();

Route::get('/profile', 'HomeController@profile');
Route::get('/profile/{user}', 'HomeController@profile');
Route::post('/profile/password', 'HomeController@updatePassword');
Route::post('/profile/avatar', 'HomeController@updateAvatar');
