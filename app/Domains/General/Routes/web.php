<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Route::get('categories', 'EndUserGeneralDomainController@categoriesIndex')->name('categories.index');
Route::get('categories/{category}', 'EndUserGeneralDomainController@categoriesShow')->name('categories.show');
Route::get('subcategory/{subcategory}', 'EndUserGeneralDomainController@subCategoriesShow')->name('sub_categories.show');

Route::group(['middleware' => [ 'auth', 'IsActive' ]], function () {
    /*AddWebRoutesCrud*/
});
