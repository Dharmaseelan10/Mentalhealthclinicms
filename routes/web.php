<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReportingController; // Added the Reporting Controller

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('assessments', AssessmentController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('users', UserController::class);
    
    // Reporting Routes
    Route::prefix('reporting')->group(function () {
        Route::get('/dashboard', [ReportingController::class, 'dashboard'])->name('reporting.dashboard');
        // Add other reporting routes here
    });
});
