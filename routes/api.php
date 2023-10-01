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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    [
        //'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',

    ], function () {
        Route::post('userregister','UserController@userRegister');
        Route::get('usuarios','UserController@usuarioIndex');
    }
    
);

Route::group(
    [
        //'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',

    ], function () {
        Route::post('vacinaregister','VacinaController@vacinaRegister');
        Route::get('vacinas','VacinaController@vacinaIndex');
    }
    
);