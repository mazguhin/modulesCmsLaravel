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
Route::group(['middleware' => ['web','isAdmin'], 'prefix' => 'dashboard/staff', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
    Route::get ('/category/create', 'BackStaffCategoryController@create'); // create category
    Route::post ('/category/create', 'BackStaffCategoryController@store'); // store category
    Route::get ('/category/edit/id/{id_category}', 'BackStaffCategoryController@editById'); // show form for edit category
    Route::post ('/category/edit/id/{id_category}', 'BackStaffCategoryController@update'); // update category
    Route::get ('/category', 'BackStaffCategoryController@show'); // show all categories
    Route::delete ('/category/{id_category}', 'BackStaffCategoryController@destroy'); // destroy category

    Route::get ('/create', 'BackStaffController@create'); // create staff
    Route::post ('/create', 'BackStaffController@store'); // store staff
    Route::get ('/edit/id/{id_staff}', 'BackStaffController@editById'); // show form for edit staff
    Route::post ('/edit/id/{id_staff}', 'BackStaffController@update'); // update staff
    Route::get ('/', 'BackStaffController@show'); // show all staff
    Route::delete ('/{id_staff}', 'BackStaffController@destroy'); // destroy staff
});

// API Front
Route::group(['middleware' => ['api','cors'], 'prefix' => 'api/staff', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
  Route::get('/category', 'ApiStaffCategoryController@index'); // show all categories

  // show members in category
  Route::get ('/category/id/{id_category}', 'ApiStaffCategoryController@showId');
  Route::get ('/category/{slug_category}', 'ApiStaffCategoryController@showSlug');

  // show staff
  Route::get ('/id/{id_staff}', 'ApiStaffController@showId');
  Route::get ('/{slug_staff}', 'ApiStaffController@showSlug');
});
