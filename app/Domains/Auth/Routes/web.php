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

Auth::routes(['verify' => false ]);
Route::group(['namespace' => '\App\Domains\Auth\Http\Controllers\EndUser\Auth'], function () {
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('login/{provider}', 'AuthSocialiteController@redirectToProvider')->where('provider', 'facebook|google')->name('login.provider.redirect');
    Route::get('login/{provider}/callback', 'AuthSocialiteController@handleProviderCallback')->where('provider', 'facebook|google')->name('login.provider.callback');
    Route::get('profile', 'ProfileController@profile')->name('profile');
    Route::patch('profile/update', 'ProfileController@updateUser')->name('profile.update');
});

Route::post('leads/send-us', 'EndUserAuthDomainController@leadsSend')->name('leads.send');
Route::get('privacy-and-policy', 'EndUserAuthDomainController@privacyAndPolicy')->name('privacy-and-policy');
Route::get('terms-and-conditions', 'EndUserAuthDomainController@termsAndConditions')->name('terms-and-conditions');

Route::group(['middleware' => [ 'auth', 'IsActive' ], 'namespace' => 'Auth', 'prefix' => 'user/profile', 'as' => 'user.'], function () {
    /*AddWebRoutesCrud*/
});
