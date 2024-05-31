<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'courses' => CourseController::class,
    'enrollments' => EnrollmentController::class,
    'students' => StudentController::class,
]);

Route::prefix('statistics')->group(function () {
    Route::get('enrollments', [EnrollmentController::class, 'statistics']);
});
