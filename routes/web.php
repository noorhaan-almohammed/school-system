<?php

use App\Http\Controllers\TeachingAssignmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user end points
Route::post('/createUser', [UserController::class, 'createUser'])->name('createWebUser');
Route::get('/users/{id}', [UserController::class, 'showUser']);
Route::post('/users/{id}', [UserController::class, 'updateUser']);

// teaching assignment end points
Route::post('/teachers/{teacher}/assign-subject', [TeachingAssignmentController::class, 'assignSubject']);
Route::delete('/assignments/{assignment}', [TeachingAssignmentController::class, 'deleteAssignment']);
