<?php


// FRONT Routes
Route::group(['middleware' => ['web','isBanned'], 'prefix' => 'article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    Route::get ('/id/{id_article}', 'ArticleController@showId');
    Route::get ('/{slug_article}', 'ArticleController@showSlug');
});

// BACK Routes
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    Route::get ('/create', 'BackArticleController@create'); // create article
    Route::post ('/create', 'BackArticleController@store'); // store article
    Route::get ('/edit/id/{id_article}', 'BackArticleController@editById'); // show form for edit article
    Route::post ('/edit/id/{id_article}', 'BackArticleController@update'); // update article
    Route::get ('/', 'BackArticleController@show'); // show all articles
    Route::delete ('/{id_article}', 'BackArticleController@destroy'); // destroy article
});


// API Front
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    Route::get ('/id/{id_article}', 'ApiArticleController@showId');
    Route::get ('/{slug_article}', 'ApiArticleController@showSlug');
});
