<?php

//FRONT
Route::group(['middleware' => 'web', 'prefix' => 'menu', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
    Route::get('/', 'MenuController@index');

});

// BACK MENU Routes
Route::group(['middleware' => ['web'], 'prefix' => 'dashboard/menu', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
      // create menu
    Route::get ('/create', 'BackMenuController@create')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // store menu
    Route::post ('/create', 'BackMenuController@store')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // show form for edit menu
    Route::get ('/edit/id/{id_menu}', 'BackMenuController@editById')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // update menu
    Route::post ('/edit/id/{id_menu}', 'BackMenuController@update')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // show all menu
    Route::get ('/', 'BackMenuController@show')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // destroy menu
    Route::delete ('/{id_menu}', 'BackMenuController@destroy')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);
});

// BACK MenuItems Routes
Route::group(['middleware' => ['web'], 'prefix' => 'dashboard/menu/item', 'namespace' => 'Modules\Menu\Http\Controllers'], function()
{
      // create item menu
    Route::get ('/create/{id_menu}', 'BackMenuItemController@create')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // store item menu
    Route::post ('/create/{id_menu}', 'BackMenuItemController@store')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // edit form for items menu
    Route::get ('/edit/id/{id_item}', 'BackMenuItemController@editById')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // update item menu
    Route::post ('/edit/id/{id_menu}', 'BackMenuItemController@update')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // show all items menu
    Route::get ('/id/{id_menu}', 'BackMenuItemController@show')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // destroy item menu
    Route::delete ('/{id_item}', 'BackMenuItemController@destroy')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);
});
