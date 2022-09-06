<?php

use Illuminate\Http\Request;
use Modules\Auth\Http\Middleware\JwtMiddleware as JwtVerify;

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

Route::prefix('/v1/auth')->group(function() {
    Route::group(['middleware' => [JwtVerify::class]], function() {
        Route::get('/employee', 'EmployeeController@getAuthenticatedUser');
    });
    Route::post('/register', 'EmployeeController@register');
    Route::post('/authenticate', 'EmployeeController@authenticate');
});
