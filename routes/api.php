<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
], function () {

    // Route for registering a new admin
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

    // Route for logging in
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    // Route for logging out
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:api');

});
   // Route users
    Route::group(['middleware' => 'auth:api'], function () {
       Route::apiResource('users', UserController::class);
    });
