<?php

Route::group(['middleware' => 'web', 'prefix' => 'article', 'namespace' => 'Modules\Article\Http\Controllers'], function()
{
    //Route::get('/', 'ArticleController@index');
    Route::get ('/id/{id_article}', 'ArticleController@showId');
    Route::get ('/{slug_article}', 'ArticleController@showSlug');
});
