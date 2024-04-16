<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SanctumAuthController;
use App\Http\Controllers\Api\PatientApiController;

// Authentication routes
Route::post('register', [SanctumAuthController::class, 'register']);
Route::post('login', [SanctumAuthController::class, 'login']);
Route::post('logout', [SanctumAuthController::class, 'logout'])->middleware('auth:sanctum');

// Routes that require authentication
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/patients/all', [PatientApiController::class, 'index']);
    Route::post('/patients/create', [PatientApiController::class, 'store']);
    Route::get('/patients/show/{patient}', [PatientApiController::class, 'show']);
    Route::match(['put', 'patch'], '/patients/{patient}/update', [PatientApiController::class, 'update']);
    Route::delete('/patients/{patient}/delete', [PatientApiController::class, 'destroy']);
    Route::get('/patients/trashed/temp', [PatientApiController::class, 'trashed']);
    Route::post('/patients/trashed/temp/{patient}/restore', [PatientApiController::class, 'restore']);
    Route::post('/patients/trashed/temp/restore-all', [PatientApiController::class, 'restoreAll']);
});


// // Routes that won't require authentication during pest tests
// Route::get('/patients/all/pest', [PatientApiController::class, 'index'])->name('patients.index.api');
// Route::post('/patients/create/pest', [PatientApiController::class, 'store'])->name('patients.store.api');
// Route::get('/patients/show/{patient}/pest', [PatientApiController::class, 'show'])->name('patients.show.api');
// Route::match(['put', 'patch'], '/patients/{patient}/update/pest', [PatientApiController::class, 'update'])->name('patients.update.api');
// Route::delete('/patients/{patient}/delete/pest', [PatientApiController::class, 'destroy'])->name('patients.destroy.api');
// Route::get('/patients/trashed/temp/pest', [PatientApiController::class, 'trashed'])->name('patients.trashed.api');
// Route::post('/patients/trashed/temp/{patient}/restore/pest', [PatientApiController::class, 'restore'])->name('patients.restore.api');
// Route::post('/patients/trashed/temp/restore-all/pest', [PatientApiController::class, 'restoreAll'])->name('patients.restoreAll.api');
