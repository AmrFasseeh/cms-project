<?php

use Illuminate\Support\Facades\Route;


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
