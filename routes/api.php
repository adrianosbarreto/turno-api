<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CheckAPIController;
use App\Http\Controllers\API\TransactionAPIController;

//
//Route::post('login', [UserController::class, 'login']);
//Route::post('register', [UserController::class, 'register']);

//
//Route::middleware('auth:api')->group(function () {
//    Route::get('user', [UserController::class, 'details']);
//});

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

