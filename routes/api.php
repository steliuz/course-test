<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\CourseController; // Import the new controller
use App\Http\Controllers\EnrollmentController; // Import the new controller
use Illuminate\Support\Facades\Route;


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::post('/academies', [AcademyController::class, 'store']);
Route::put('/academies/{id}', [AcademyController::class, 'update']);

Route::post('/courses', [CourseController::class, 'store']);
Route::put('/courses/{id}', [CourseController::class, 'update']);

Route::get('/courses', [CourseController::class, 'index']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

Route::get('/enrollments', [EnrollmentController::class, 'index']);

Route::middleware(['auth:sanctum','check:admin'])->group(function () {
});

Route::middleware(['auth:sanctum','check:user'])->group(function () {
    Route::post('/enrollments', [EnrollmentController::class, 'store']);
});