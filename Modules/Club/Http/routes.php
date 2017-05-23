<?php

// FRONT Routes
Route::group(['middleware' => ['web'], 'prefix' => 'club/id/{id_club}', 'namespace' => 'Modules\Club\Http\Controllers'], function()
{
    Route::get ('/', 'ClubController@index'); // show club


    // NEWS
    Route::get ('/news/id/{id_article}', 'ClubNewsController@show'); // show news in club
    Route::get ('/news/create', 'ClubNewsController@create'); // create news in club
    Route::post ('/news/create', 'ClubNewsController@store'); // store news in club
    Route::get ('/news/edit/{id_article}', 'ClubNewsController@edit'); // edit news in club
    Route::post ('/news/edit/{id_article}', 'ClubNewsController@save'); // save news in club
    Route::delete ('/news/delete/{id_article}', 'ClubNewsController@delete'); // delete news in club

    // INFO
    Route::get ('/info/id/{id_article}', 'ClubInfoController@show'); // show info in club
    Route::get ('/info/create', 'ClubInfoController@create'); // create info in club
    Route::post ('/info/create', 'ClubInfoController@store'); // store info in club
    Route::get ('/info/edit/{id_article}', 'ClubInfoController@edit'); // edit info in club
    Route::post ('/info/edit/{id_article}', 'ClubInfoController@save'); // save info in club
    Route::delete ('/info/delete/{id_article}', 'ClubInfoController@delete'); // delete info in club


});

// BACK Routes
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/club', 'namespace' => 'Modules\Club\Http\Controllers'], function()
{
    Route::get ('/create', 'BackClubController@create'); // create club
    Route::post ('/create', 'BackClubController@store'); // store club
    Route::get ('/edit/id/{id_club}', 'BackClubController@editById'); // show form for edit club
    Route::post ('/edit/id/{id_club}', 'BackClubController@update'); // update club
    Route::get ('/', 'BackClubController@show'); // show all clubs
    Route::delete ('/{id_club}', 'BackClubController@destroy'); // destroy club
});
