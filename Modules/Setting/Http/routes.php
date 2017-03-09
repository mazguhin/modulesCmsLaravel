<?php

Route::group(['middleware' => 'web', 'prefix' => '/dashboard/setting', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::get('/', 'SettingController@index')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    Route::post('/', 'SettingController@update')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    Route::post('/startpage/{id}', 'SettingController@setStartPage')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);
});
