<?php

Route::group(['middleware' => ['web','Modules\Article\Http\Middleware\isAdmin'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('/', 'DashboardController@index');
});
