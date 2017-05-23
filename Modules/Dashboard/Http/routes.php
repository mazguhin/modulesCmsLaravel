<?php

Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('/', 'DashboardController@index');
});

Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/user', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
  Route::get ('/create', 'BackUserController@create'); // create user
  Route::post ('/create', 'BackUserController@store'); // store user
  Route::get ('/edit/id/{id_user}', 'BackUserController@editById'); // show form for edit user
  Route::post ('/edit/id/{id_user}', 'BackUserController@update'); // update user
  Route::post ('/ban/id/{id_user}', 'BackUserController@ban'); // ban user
  Route::post ('/unban/id/{id_user}', 'BackUserController@unban'); // unban user
  Route::get ('/', 'BackUserController@show'); // show all users
});


// API
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('/auth', 'ApiController@authenticate');
});
