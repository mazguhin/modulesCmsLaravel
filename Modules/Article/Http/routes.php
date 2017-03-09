<?php


// FRONT Routes
Route::group(['middleware' => 'web', 'prefix' => 'article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    Route::get ('/id/{id_article}', 'ArticleController@showId');
    Route::get ('/{slug_article}', 'ArticleController@showSlug');
});

// BACK Routes
Route::group(['middleware' => ['web'], 'prefix' => 'dashboard/article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
      // create article
    Route::get ('/create', 'BackArticleController@create')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    // store article
    Route::post ('/create', 'BackArticleController@store')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    // show form for edit article
    Route::get ('/edit/id/{id_article}', 'BackArticleController@editById')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    // update article
    Route::post ('/edit/id/{id_article}', 'BackArticleController@update')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    // show all articles
    Route::get ('/', 'BackArticleController@show')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);

    // destroy article
    Route::delete ('/{id_article}', 'BackArticleController@destroy')
    ->middleware(['Modules\Dashboard\Http\Middleware\isAdmin']);
});
