<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

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

Route::group([
    'middleware' => 'api'
], function (Router $router){
    Route::group([
        'prefix' => 'v1',
        'as' => 'api.',
        'namespace' => 'Api\V1',
    ], function(){
        Route::apiResource('drugs', 'DrugApiController');
    });
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
        Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
        Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::post('refresh', [App\Http\Controllers\Api\AuthController::class, 'refresh']);
        Route::post('me', [App\Http\Controllers\Api\AuthController::class, 'me']);
    });
});


