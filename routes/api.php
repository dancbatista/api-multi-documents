<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    echo "api rodando";
});

Route::group(['middleware' => ['apiJwt', 'checkUserType'], 'prefix' => 'auth',], function ($router) {

    //User
    Route::middleware(['checkUser'])->group(function () {
        Route::post('user/{id}', 'V1\\UserController@update');
        Route::get('user/{id}', 'V1\\UserController@show');
    });

    //User Type
    Route::middleware(['blockRoute'])->group(function () {
        Route::post('user-type-register', 'V1\\UserTypeController@store');
        Route::post('user-type-update/{id}', 'V1\\UserTypeController@update');

        Route::get('user-type-show/{id}', 'V1\\UserTypeController@show');
        Route::get('user-type', 'V1\\UserTypeController@index');

    });
});

Route::group(['prefix' => ''], function ($router) {
    Route::post('user', 'V1\\UserController@store');
    Route::post('login', 'V1\\AuthController@login');
    Route::post('enterprise', 'V1\\EnterpriseController@store');
    Route::get('enterprise', 'V1\\EnterpriseController@index');
    Route::get('enterprise/{id}', 'V1\\EnterpriseController@show');
    Route::post('enterprise/{id}', 'V1\\EnterpriseController@update');
});
