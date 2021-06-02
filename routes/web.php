<?php

use Illuminate\Support\Facades\Route;

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

Route::get(config('system.admin.url_prefix'), 'EnduserWebsiteController@redirectToDashboard');
Route::get('change-lang-{lang}', 'EnduserWebsiteController@changeLang')->name('lang.change');
Route::get('/', 'EnduserWebsiteController@indexPage')->name('index');
