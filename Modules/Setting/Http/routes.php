<?php

Route::group(['middleware' => ['web','isAdmin'], 'prefix' => '/dashboard/setting', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
    Route::get('/', 'SettingController@index');
    Route::post('/', 'SettingController@update');
    Route::post('/startpage/{id}', 'SettingController@setStartPage');
});
