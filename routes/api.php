<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(
    [
        ['middleware' => ['apiJwt']],
        'prefix' => 'auth',
        'namespace' => 'App\Http\Controllers',

    ], function () {
        Route::post('userregister','UserController@userRegister')->middleware('apiJwt');;
        Route::get('usuarios','UserController@usuarioIndex')->middleware('apiJwt');
    }
    
);



Route::group(
    [
        ['middleware' => ['apiJwt']],
        'prefix' => 'auth',
        'namespace' => 'App\Http\Controllers',

    ], function () {
        Route::post('vacinaregister','VacinaController@vacinaRegister')->middleware('apiJwt');;
        Route::get('vacinas','VacinaController@vacinaIndex')->middleware('apiJwt');;
    }
    
);

Route::group([

    //'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers',

], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::get('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
        Route::post('aplicadorregister','AuthController@aplicadorregister');
    }
);