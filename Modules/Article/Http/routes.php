<?php

// FRONT Routes
Route::group(['middleware' => 'web', 'prefix' => 'article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    Route::get ('/id/{id_article}', 'ArticleController@showId');
    Route::get ('/{slug_article}', 'ArticleController@showSlug');
});

// FRONT Routes
Route::group(['middleware' => ['web'], 'prefix' => 'dashboard/article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    // edit article
    Route::get ('/edit/id/{id_article}', 'BackArticleController@edit')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin','Modules\Article\Http\Middleware\isAdmin']);
    Route::get ('/edit/{slug_article}', 'BackArticleController@edit')
    ->middleware(['Modules\Article\Http\Middleware\isAdmin','Modules\Article\Http\Middleware\isAdmin']);
});
