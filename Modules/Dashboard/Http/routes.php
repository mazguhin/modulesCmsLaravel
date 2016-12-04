<?php

Route::group(['middleware' => ['web','Modules\Article\Http\Middleware\isAdmin'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('/', 'DashboardController@index');
});

Route::group(['middleware' => ['web','Modules\Article\Http\Middleware\isAdmin'], 'prefix' => 'dashboard/user', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
  // create user
  Route::get ('/create', 'BackUserController@create')
  ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

  // store user
  Route::post ('/create', 'BackUserController@store')
  ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

  // show form for edit user
  Route::get ('/edit/id/{id_user}', 'BackUserController@editById')
  ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

  // update user
  Route::post ('/edit/id/{id_user}', 'BackUserController@update')
  ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

  // show all users
  Route::get ('/', 'BackUserController@show')
  ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

  // destroy user
  Route::delete ('/{id_user}', 'BackUserController@destroy')
  ->middleware(['Modules\Article\Http\Middleware\isAdmin']);
});
