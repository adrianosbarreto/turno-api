<?php

use App\Http\Controllers\API\AccountAPIController;
use App\Http\Controllers\API\Customer\CheckAPIController;
use App\Http\Controllers\API\RegisterAPIController;
use App\Http\Controllers\API\TransactionAPIController;
use Illuminate\Support\Facades\Route;


Route::middleware('throttle:api')->group(function () {

    //REGISTER AND LOGIN ROUTES
    Route::post('login', [RegisterAPIController::class, 'login']);
    Route::post('register', [RegisterAPIController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [RegisterAPIController::class, 'logout']);
    });

    //ADMIN ROUTES
    Route::middleware(['auth:sanctum','role:admin', 'handle.unauthorized'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('/checks')->group(function () {
                Route::get('/{id}', [\App\Http\Controllers\API\Admin\CheckAPIController::class, 'show']);
                Route::post('/pending', [\App\Http\Controllers\API\Admin\CheckAPIController::class, 'getPendingChecks']);
                Route::post('/approve/{id}', [\App\Http\Controllers\API\Admin\CheckAPIController::class, 'approveCheck']);
                Route::post('/reject/{id}', [\App\Http\Controllers\API\Admin\CheckAPIController::class, 'rejectCheck']);
            });
        });
    });

    //GENERAL USE ROUTES
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('checks')->group(function () {
            Route::post('/', [CheckAPIController::class, 'store']);
            Route::get('/', [CheckAPIController::class, 'index']);
            Route::post('/status-filter', [CheckAPIController::class, 'filter']);
            Route::post('/month-year-filter', [CheckAPIController::class, 'index']);

        });

        Route::prefix('transactions')->group(function () {
            Route::post('/', [TransactionAPIController::class, 'store']);
            Route::get('/', [TransactionAPIController::class, 'index']);
            Route::post('/type-filter', [TransactionAPIController::class, 'filter']);
        });

        Route::prefix('account')->group(
            function () {
                Route::get('/balance/{account_id}', [AccountAPIController::class, 'balance']);
            }
        );
    });
});





