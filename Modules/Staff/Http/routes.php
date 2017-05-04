<?php

Route::group(['middleware' => 'web', 'prefix' => 'staff', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
    Route::get('/', 'StaffController@index');
});

// FRONT Routes
Route::group(['middleware' => 'web', 'prefix' => 'staff', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
    // show all categories
    Route::get('/category', 'StaffCategoryController@index');
    // show members in category
    Route::get ('/category/id/{id_category}', 'StaffCategoryController@showId');
    Route::get ('/category/{slug_category}', 'StaffCategoryController@showSlug');

    // show staff
    Route::get ('/id/{id_staff}', 'StaffController@showId');
    Route::get ('/{slug_staff}', 'StaffController@showSlug');
});

// BACK Routes
Route::group(['middleware' => ['web','Modules\Dashboard\Http\Middleware\isAdmin'], 'prefix' => 'dashboard/staff', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
    // create category
    Route::get ('/category/create', 'BackStaffCategoryController@create');
    // store category
    Route::post ('/category/create', 'BackStaffCategoryController@store');
    // show form for edit category
    Route::get ('/category/edit/id/{id_category}', 'BackStaffCategoryController@editById');
    // update category
    Route::post ('/category/edit/id/{id_category}', 'BackStaffCategoryController@update');
    // show all categories
    Route::get ('/category', 'BackStaffCategoryController@show');
    // destroy category
    Route::delete ('/category/{id_category}', 'BackStaffCategoryController@destroy');


    // create staff
    Route::get ('/create', 'BackStaffController@create');
    // store staff
    Route::post ('/create', 'BackStaffController@store');
    // show form for edit staff
    Route::get ('/edit/id/{id_staff}', 'BackStaffController@editById');
    // update staff
    Route::post ('/edit/id/{id_staff}', 'BackStaffController@update');
    // show all staff
    Route::get ('/', 'BackStaffController@show');
    // destroy staff
    Route::delete ('/{id_staff}', 'BackStaffController@destroy');
    // search user
    Route::get ('/search', 'BackStaffController@search');
});
