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

Route::group(['middleware' => [ 'auth', 'IsAdmin' ]], function () {
    Route::get('generals', 'AdminPanelGeneralDomainController@index')->name('generals');

    Route::resource('brands', 'AdminBrandsController')->except(['show',]);
    Route::group(['as' => 'brands.'], function () {
        Route::get('brands/{brand}/changeStatus', 'AdminBrandsController@changeStatus')->name('changeStatus');
        Route::delete('brands/{brand}/delete', 'AdminBrandsController@delete')->name('delete');
        Route::post('brands/{brand}/restore', 'AdminBrandsController@restore')->name('restore');
        Route::post('brands/multi-delete', 'AdminBrandsController@multiDelete')->name('multi.delete');
        Route::post('brands/multi-restore', 'AdminBrandsController@multiRestore')->name('multi.restore');
        Route::post('brands/multi-order', 'AdminBrandsController@multiOrder')->name('multi.order');
    });

    Route::resource('types', 'AdminTypesController')->except(['show',]);
    Route::group(['as' => 'types.'], function () {
        Route::get('types/{type}/changeStatus', 'AdminTypesController@changeStatus')->name('changeStatus');
        Route::delete('types/{type}/delete', 'AdminTypesController@delete')->name('delete');
        Route::post('types/{type}/restore', 'AdminTypesController@restore')->name('restore');
        Route::post('types/multi-delete', 'AdminTypesController@multiDelete')->name('multi.delete');
        Route::post('types/multi-restore', 'AdminTypesController@multiRestore')->name('multi.restore');
        Route::post('types/multi-order', 'AdminTypesController@multiOrder')->name('multi.order');
    });

    Route::group(['namespace' => 'Categories'], function () {
        Route::resource('categories', 'AdminCategoriesController')->except(['show',]);
        Route::group(['as' => 'categories.'], function () {
            Route::get('categories/{category}/changeStatus', 'AdminCategoriesController@changeStatus')->name('changeStatus');
            Route::delete('categories/{category}/delete', 'AdminCategoriesController@delete')->name('delete');
            Route::post('categories/{category}/restore', 'AdminCategoriesController@restore')->name('restore');
            Route::post('categories/multi-delete', 'AdminCategoriesController@multiDelete')->name('multi.delete');
            Route::post('categories/multi-restore', 'AdminCategoriesController@multiRestore')->name('multi.restore');
            Route::post('categories/multi-order', 'AdminCategoriesController@multiOrder')->name('multi.order');
        });

        Route::resource('subcategories', 'AdminSubcategoriesController')->except(['show',]);
        Route::group(['as' => 'subcategories.'], function () {
            Route::get('subcategories/{subcategory}/changeStatus', 'AdminSubcategoriesController@changeStatus')->name('changeStatus');
            Route::delete('subcategories/{subcategory}/delete', 'AdminSubcategoriesController@delete')->name('delete');
            Route::post('subcategories/{subcategory}/restore', 'AdminSubcategoriesController@restore')->name('restore');
            Route::post('subcategories/multi-delete', 'AdminSubcategoriesController@multiDelete')->name('multi.delete');
            Route::post('subcategories/multi-restore', 'AdminSubcategoriesController@multiRestore')->name('multi.restore');
            Route::post('subcategories/multi-order', 'AdminSubcategoriesController@multiOrder')->name('multi.order');
        });

        Route::resource('subcategorytypes', 'AdminSubcategorytypesController')->except(['show',]);
        Route::group(['as' => 'subcategorytypes.'], function () {
            Route::get('subcategorytypes/{subcategorytype}/changeStatus', 'AdminSubcategorytypesController@changeStatus')->name('changeStatus');
            Route::delete('subcategorytypes/{subcategorytype}/delete', 'AdminSubcategorytypesController@delete')->name('delete');
            Route::post('subcategorytypes/{subcategorytype}/restore', 'AdminSubcategorytypesController@restore')->name('restore');
            Route::post('subcategorytypes/multi-delete', 'AdminSubcategorytypesController@multiDelete')->name('multi.delete');
            Route::post('subcategorytypes/multi-restore', 'AdminSubcategorytypesController@multiRestore')->name('multi.restore');
            Route::post('subcategorytypes/multi-order', 'AdminSubcategorytypesController@multiOrder')->name('multi.order');
        });
    });
    /*AddAdminRoutesCrud*/
});
