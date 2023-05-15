<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'role:operator'], 'prefix' => '/operator'], function () {
    Route::group(['prefix' => '/entity'], function () {
        Route::get('/{id}', [\App\Http\Controllers\Api\Operator\EntityController::class, 'get']);
        Route::post('/getAll', [\App\Http\Controllers\Api\Operator\EntityController::class, 'getAll']);
        Route::post('/update', [\App\Http\Controllers\Api\Operator\EntityController::class, 'update']);
        Route::post('/{id}/assignAttribute', [\App\Http\Controllers\Api\Operator\EntityController::class, 'assignAttribute']);
    });
});
