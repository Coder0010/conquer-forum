<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*AddApiRoutesCrud*/
Route::group(['namespace' => '\App\Domains\General\Http\Controllers\SAC'], function () {
    Route::post('get-all-categories', 'GetCategory');
});
