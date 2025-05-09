<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParentStudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectPerformanceController;
use App\Http\Controllers\TeachingAssignmentController;
use App\Models\Event;
use App\Models\ParentStudent;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user end points
Route::post('/createUser', [UserController::class, 'createUser'])->name('createWebUser');
Route::get('/users/{id}', [UserController::class, 'showUser']);
Route::get('/users/{id}/subject/class', [UserController::class, 'showUserWithSubjectAndClass']);
Route::post('/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/{id}',[UserController::class, 'deleteUser']);
// teaching assignment end points
Route::post('/teachers/{teacher}/assign-subject', [TeachingAssignmentController::class, 'assignSubject']);
Route::delete('/assignments/{assignment}', [TeachingAssignmentController::class, 'deleteAssignment']);


// subject
Route::get('/subject/{id}', [SubjectController::class, 'show']);
Route::post('/subject/{id}', [SubjectController::class, 'update']);


//event
Route::post('/createEvent', [EventController::class, 'createEvent'])->name('createEvent');
Route::delete('/event/{id}', [EventController::class, 'destroy']);
//parent student
Route::post('/parent/{parent}/assign-child', [ParentStudentController::class, 'assignChild']);
Route::delete('/children/{assignment}', [ParentStudentController::class, 'deleteChild']);

//performance
Route::post('/student/grades/update', [SubjectPerformanceController::class, 'updateStudentGrades'])->name('student.grades.update');

//attedence
Route::post('/attendances/toggle', [AttendanceController::class, 'toggle']);
Route::get('/attendances/summary/{student}', [AttendanceController::class, 'summary']);

