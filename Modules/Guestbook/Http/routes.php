<?php

Route::group(['middleware' => ['web','isBanned'], 'prefix' => 'guestbook', 'namespace' => 'Modules\Guestbook\Http\Controllers'], function()
{
    Route::get('/', 'GuestbookController@index');
});

Route::group(['middleware' => ['web','auth','isBanned'], 'prefix' => 'guestbook', 'namespace' => 'Modules\Guestbook\Http\Controllers'], function()
{
    Route::post('/', 'GuestbookController@store');
});

Route::group(['middleware' => ['web','auth', 'isAdmin'], 'prefix' => '/dashboard/guestbook', 'namespace' => 'Modules\Guestbook\Http\Controllers'], function()
{
    Route::get('/', 'BackGuestbookController@index');
    Route::get('/{question}', 'BackGuestbookController@show');
    Route::get('/edit/{question}', 'BackGuestbookController@edit');
    Route::post('/edit/{question}', 'BackGuestbookController@save');
    Route::post('/{question}', 'BackGuestbookController@setAnswer');
    Route::delete('/{question}', 'BackGuestbookController@delete');
});
