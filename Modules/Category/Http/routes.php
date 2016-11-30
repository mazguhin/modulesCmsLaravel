<?php

// FRONT Routes
Route::group(['middleware' => 'web', 'prefix' => 'category', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
    // show all categories
    Route::get('/', 'CategoryController@index');

    // show articles in category
    Route::get ('/id/{id_category}', 'CategoryController@showId');
    Route::get ('/{slug_category}', 'CategoryController@showSlug');
});

// BACK Routes
Route::group(['middleware' => ['web'], 'prefix' => 'dashboard/category', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
      // create category
    Route::get ('/create', 'BackCategoryController@create')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // store category
    Route::post ('/create', 'BackCategoryController@store')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // show form for edit category
    Route::get ('/edit/id/{id_category}', 'BackCategoryController@editById')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // update category
    Route::post ('/edit/id/{id_category}', 'BackCategoryController@update')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // show all categories
    Route::get ('/', 'BackCategoryController@show')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);

    // destroy category
    Route::delete ('/{id_category}', 'BackCategoryController@destroy')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin']);
});
