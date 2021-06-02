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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'AdminLoginController@showLoginForm')->name('showlogin');
    Route::post('login-check', 'AdminLoginController@login')->name('login');
    Route::post('process-logout', 'AdminLoginController@logout')->name('logout');
    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('reset-form', 'AdminForgetPasswordController@showLinkRequestForm')->name('request');
        Route::post('email', 'AdminForgetPasswordController@sendResetLinkEmail')->name('email');
        Route::get('reset/{token?}', 'AdminResetPasswordController@showResetForm')->name('reset');
        Route::post('reset', 'AdminResetPasswordController@reset')->name('update');
    });
});
Route::group(['middleware' => [ 'auth', 'IsAdmin' ]], function () {
    Route::get('auths', 'AdminPanelAuthDomainController@index')->name('auths');

    Route::get('dashboard', 'AdminDashboardController@index')->name('dashboard');
    Route::resource('users', 'AdminUsersController');
    Route::group(['as' => 'users.'], function () {
        Route::get('users/{user}/changeStatus', 'AdminUsersController@changeStatus')->name('changeStatus');
        Route::delete('users/{user}/delete', 'AdminUsersController@delete')->name('delete');
        Route::post('users/{user}/restore', 'AdminUsersController@restore')->name('restore');
        Route::post('users/multi-delete', 'AdminUsersController@multiDelete')->name('multi.delete');
        Route::post('users/multi-restore', 'AdminUsersController@multiRestore')->name('multi.restore');
        Route::post('users/multi-order', 'AdminUsersController@multiOrder')->name('multi.order');
    });

    Route::resource('roles', 'AdminRolesController')->except(['show','destory',]);
    Route::group(['as' => 'roles.'], function () {
        Route::delete('roles/{role}/delete', 'AdminRolesController@delete')->name('delete');
        Route::post('roles/multi-delete', 'AdminRolesController@multiDelete')->name('multi.delete');
        Route::post('roles/multi-restore', 'AdminRolesController@multiRestore')->name('multi.restore');
        Route::post('roles/multi-order', 'AdminRolesController@multiOrder')->name('multi.order');
    });

    Route::resource('leads', 'AdminLeadsController')->except(['show',]);
    Route::group(['as' => 'leads.'], function () {
        Route::get('leads/{lead}/changeStatus', 'AdminLeadsController@changeStatus')->name('changeStatus');
        Route::delete('leads/{lead}/delete', 'AdminLeadsController@delete')->name('delete');
        Route::post('leads/{lead}/restore', 'AdminLeadsController@restore')->name('restore');
        Route::post('leads/multi-delete', 'AdminLeadsController@multiDelete')->name('multi.delete');
        Route::post('leads/multi-restore', 'AdminLeadsController@multiRestore')->name('multi.restore');
        Route::post('leads/multi-order', 'AdminLeadsController@multiOrder')->name('multi.order');
    });
    /*AddAdminRoutesCrud*/
});
