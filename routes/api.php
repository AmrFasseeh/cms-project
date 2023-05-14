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

Route::group(['prefix' => '/auth'], function() {
    Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => '/admin'], function() {
    Route::group(['prefix' => '/entity'], function() {
        Route::get('/{id}', [\App\Http\Controllers\Api\Admin\EntityController::class, 'get']);
        Route::post('/getAll', [\App\Http\Controllers\Api\Admin\EntityController::class, 'getAll']);
        Route::post('/create', [\App\Http\Controllers\Api\Admin\EntityController::class, 'create']);
        Route::post('/update', [\App\Http\Controllers\Api\Admin\EntityController::class, 'update']);
        Route::post('/delete', [\App\Http\Controllers\Api\Admin\EntityController::class, 'delete']);
        Route::post('/{id}/assignAttribute', [\App\Http\Controllers\Api\Admin\EntityController::class, 'assignAttribute']);
        Route::post('/assignEntity', [\App\Http\Controllers\Api\Admin\EntityController::class, 'assignEntity']);
    });

    Route::group(['prefix' => '/operator'], function() {
        Route::get('/{id}', [\App\Http\Controllers\Api\Admin\OperatorController::class, 'get']);
        Route::post('/getAll', [\App\Http\Controllers\Api\Admin\OperatorController::class, 'getAll']);
        Route::post('/create', [\App\Http\Controllers\Api\Admin\OperatorController::class, 'create']);
        Route::post('/update', [\App\Http\Controllers\Api\Admin\OperatorController::class, 'update']);
        Route::post('/delete', [\App\Http\Controllers\Api\Admin\OperatorController::class, 'delete']);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'role:operator'], 'prefix' => '/operator'], function() {
    Route::group(['prefix' => '/entity'], function() {
        Route::get('/{id}', [\App\Http\Controllers\Api\Operator\EntityController::class, 'get']);
        Route::post('/getAll', [\App\Http\Controllers\Api\Operator\EntityController::class, 'getAll']);
        Route::post('/update', [\App\Http\Controllers\Api\Operator\EntityController::class, 'update']);
        Route::post('/{id}/assignAttribute', [\App\Http\Controllers\Api\Operator\EntityController::class, 'assignAttribute']);
    });
});
