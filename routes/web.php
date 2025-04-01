<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/auth/login', function () {
        return view('login');
    })->name('login');
    Route::get('/auth/register', function () {
        return view('register');
    })->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/academies', [AcademyController::class, 'index'])->name('academies.index');
    Route::post('/academies', [AcademyController::class, 'store'])->name('academies.store');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

    Route::get('/enrollments', function () {
        return view('enrollments');
    })->name('enrollments.index');
});

Route::middleware(['auth', 'check:father'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
});

Route::middleware(['auth', 'check:admin'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});
