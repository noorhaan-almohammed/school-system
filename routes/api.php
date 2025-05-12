<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Auth::routes();
//auth api
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/me', function () {
        return response()->json([
            'user' => Auth::user()
        ]);
    });
    Route::get('/users', [UserController::class, 'showUserInfoBacedOnRole']);
});


