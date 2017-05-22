<?php

Route::group(['middleware' => 'web', 'prefix' => 'block', 'namespace' => 'Modules\Block\Http\Controllers'], function()
{
    Route::get('/', 'BlockController@index');
});

// BACK Routes
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/block', 'namespace' => 'Modules\Block\Http\Controllers'], function()
{
    Route::get ('/create', 'BackBlockController@create'); // create block
    Route::post ('/create', 'BackBlockController@store'); // store block
    Route::get ('/edit/{block}', 'BackBlockController@edit'); // show form for edit block
    Route::post ('/edit/{block}', 'BackBlockController@update'); // update block
    Route::get ('/', 'BackBlockController@show'); // show all blocks
    Route::delete ('/{block}', 'BackBlockController@destroy'); // destroy block
});
