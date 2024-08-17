<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;



Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

//protected routes
Route::middleware('token')->group(function () {
    Route::get('profile', [AuthenticationController::class, 'profile']);
    Route::get('logout', [AuthenticationController::class, 'logout']);
});

