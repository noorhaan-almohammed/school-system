<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/createUser',[UserController::class , 'createUser'])->name('createWebUser');


// routes/web.php
Route::get('/teachers/{id}', [UserController::class, 'showTeacher']);
Route::post('/teachers/{id}', [UserController::class, 'updateTeacher']);
