<?php

Route::group(['middleware' => 'web', 'prefix' => '/dashboard/setting', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::get('/', 'SettingController@index')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    Route::post('/', 'SettingController@update')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);
});
