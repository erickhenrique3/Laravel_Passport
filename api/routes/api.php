<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;



Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);

//protected routes
Route::middleware('auth:api')->group(function () {
    Route::get('profile', [ApiController::class, 'profile']);
    Route::get('logout', [ApiController::class, 'logout']);
});

