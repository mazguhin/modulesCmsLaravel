<?php

Route::group(['middleware' => 'web', 'prefix' => 'menu', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get('/', 'MenuController@index');

    Route::get('/render/{menu_id}', 'MenuController@render');
});
