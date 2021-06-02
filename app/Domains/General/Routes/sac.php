<?php

/*
|--------------------------------------------------------------------------
| sac Routes
|--------------------------------------------------------------------------
|
| Here is where you can register sac routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'sac' middleware group. Now create something great!
|
*/

Route::get('/get-sub-categories-by-category', 'GetSubCategory')->name('get-sub-categories');
Route::get('/get-sub-category-types-by-subcategory', 'GetSubCategoryType')->name('get-sub-category-types');

Route::group(['middleware' => [ 'auth', 'IsActive' ]], function () {

});
