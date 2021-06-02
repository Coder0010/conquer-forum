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
    Route::get('settings', 'AdminPanelSettingDomainController@index')->name('settings');

    Route::get('media-setting/key/{key}', 'AdminSettingController@generalSettingMedia')->name('settings.media-setting');
    Route::get('settings/edit', 'AdminSettingController@edit')->name('settings.edit');
    Route::post('settings/update', 'AdminSettingController@update')->name('settings.update');
    /*AddAdminRoutesCrud*/
});
