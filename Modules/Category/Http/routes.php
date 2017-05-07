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
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/category', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
    Route::get ('/create', 'BackCategoryController@create'); // create category
    Route::post ('/create', 'BackCategoryController@store'); // store category
    Route::get ('/edit/id/{id_category}', 'BackCategoryController@editById'); // show form for edit category
    Route::post ('/edit/id/{id_category}', 'BackCategoryController@update'); // update category
    Route::get ('/', 'BackCategoryController@show'); // show all categories
    Route::delete ('/{id_category}', 'BackCategoryController@destroy'); // destroy category
    Route::get ('/search', 'BackCategoryController@search'); // search article
});

// API Front
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/category', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
    Route::get('/', 'ApiCategoryController@index');
    Route::get ('/id/{id_category}', 'ApiCategoryController@showId');
    Route::get ('/{slug_category}', 'ApiCategoryController@showSlug');
});
