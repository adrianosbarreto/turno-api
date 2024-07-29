<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//
//Route::post('login', [UserController::class, 'login']);
//Route::post('register', [UserController::class, 'register']);

Route::get('teste', function () {
    return response()->json(['message' => 'Hello World!']);
});
//
//Route::middleware('auth:api')->group(function () {
//    Route::get('user', [UserController::class, 'details']);
//});

Route::resource('user-datas', App\Http\Controllers\API\UserDataAPIController::class)
    ->except(['create', 'edit']);

Route::resource('transactions', App\Http\Controllers\API\TransactionAPIController::class)
    ->except(['create', 'edit']);

Route::resource('checks', App\Http\Controllers\API\CheckAPIController::class)
    ->except(['create', 'edit']);
