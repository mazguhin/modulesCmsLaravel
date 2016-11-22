<?php

Route::group(['middleware' => 'web', 'prefix' => 'template', 'namespace' => 'Modules\Template\Http\Controllers'], function()
{
    Route::get('/', 'TemplateController@index');
});
