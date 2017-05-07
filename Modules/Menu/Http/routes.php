<?php

//FRONT
Route::group(['middleware' => 'web', 'prefix' => 'menu', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get('/', 'MenuController@index');

});

// BACK MENU Routes
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/menu', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get ('/create', 'BackMenuController@create'); // create menu
    Route::post ('/create', 'BackMenuController@store'); // store menu
    Route::get ('/edit/id/{id_menu}', 'BackMenuController@editById'); // show form for edit menu
    Route::post ('/edit/id/{id_menu}', 'BackMenuController@update'); // update menu
    Route::get ('/', 'BackMenuController@show'); // show all menu
    Route::delete ('/{id_menu}', 'BackMenuController@destroy'); // destroy menu
});

// BACK MenuItems Routes
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/menu/item', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get ('/create/{id_menu}', 'BackMenuItemController@create'); // create item menu
    Route::post ('/create/{id_menu}', 'BackMenuItemController@store'); // store item menu
    Route::get ('/edit/id/{id_item}', 'BackMenuItemController@editById'); // edit form for items menu
    Route::post ('/edit/id/{id_menu}', 'BackMenuItemController@update'); // update item menu
    Route::get ('/id/{id_menu}', 'BackMenuItemController@show'); // show all items menu
    Route::delete ('/{id_item}', 'BackMenuItemController@destroy'); // destroy item menu
});

// API Front
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/menu', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get('/', 'ApiMenuController@index');
});
