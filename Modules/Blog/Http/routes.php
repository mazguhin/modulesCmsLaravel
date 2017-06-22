<?php

// FRONT Routes
Route::group(['middleware' => ['web','isBanned'], 'prefix' => 'blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
    // show blog
    Route::get ('/id/{blog}', 'BlogController@showId');
    Route::get ('/{slug_blog}', 'BlogController@showSlug');

    Route::get ('/id/{blog}/article/{article}', 'ArticleController@show');
    Route::get ('/id/{blog}/category/{category}', 'CategoryController@show');
});

// BACK Routes
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/blog', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
    Route::get ('/create', 'BackBlogController@create'); // create blog
    Route::post ('/create', 'BackBlogController@store'); // store blog
    Route::get ('/edit/id/{blog}', 'BackBlogController@editById'); // show form for edit blog
    Route::post ('/edit/id/{blog}', 'BackBlogController@update'); // update blog
    Route::get ('/', 'BackBlogController@show'); // show all blogs
    Route::delete ('/{blog}', 'BackBlogController@destroy'); // destroy blog
});

// BACK Routes
Route::group(['middleware' => ['web'], 'prefix' => 'blog/id/{blog}', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
    Route::post('/about/edit', 'BlogController@editAbout');
    Route::post('/title/edit', 'BlogController@editTitle');

    Route::post('/category/create', 'CategoryController@store');
    Route::post('/category/edit/{category}', 'CategoryController@save');
    Route::delete('/category/{category}', 'CategoryController@delete');

    Route::post('/article/create', 'ArticleController@store');
    Route::post('/article/edit/{article}', 'ArticleController@save');
    Route::delete('/article/{article}', 'ArticleController@delete');
});
