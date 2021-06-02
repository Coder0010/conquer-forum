<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('blogs', 'EndUserSettingDomainController@blogsIndex')->name("blogs.index");
Route::get('blogs/{blog}', 'EndUserSettingDomainController@blogsShow')->name("blogs.show");
Route::get('galleries', 'EndUserSettingDomainController@galleriesIndex')->name("galleries.index");
Route::get('galleries/{gallery}', 'EndUserSettingDomainController@galleriesShow')->name("galleries.show");
Route::get('about-us', 'EndUserSettingDomainController@aboutUs')->name("about_us");
Route::get('contact-us', 'EndUserSettingDomainController@contactUs')->name("contact_us");

Route::group(["middleware" => [ "auth", "IsActive" ]], function () {
    /*AddWebRoutesCrud*/
});
