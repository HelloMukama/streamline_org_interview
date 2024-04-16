<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\MedicalDiagnosisController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Api\ApiPlaygroundController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::middleware(['auth', 'pest'])->group(function () {
Route::middleware(['auth'])->group(function () {  // redirect to login if not authenticated
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/users', [AdministratorController::class, 'index'])->name('users.index');

    Route::get('/users/{id}', [AdministratorController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [AdministratorController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [AdministratorController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{id}', [AdministratorController::class, 'destroy'])->name('users.destroy');

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::get('/patients/trashed/temp', [PatientController::class, 'trashed'])->name('patients.trashed');
    Route::post('/patients/trashed/temp/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore');
    Route::post('/patients/trashed/temp/restore-all', [PatientController::class, 'restoreAll'])->name('patients.restoreAll');

    Route::get('/clinics', [ClinicController::class, 'index'])->name('clinics.index');
    Route::get('/clinics/create', [ClinicController::class, 'create'])->name('clinics.create');
    Route::post('/clinics', [ClinicController::class, 'store'])->name('clinics.store');
    Route::get('/clinics/{clinic}', [ClinicController::class, 'show'])->name('clinics.show');
    Route::get('/clinics/{clinic}/edit', [ClinicController::class, 'edit'])->name('clinics.edit');
    Route::put('/clinics/{clinic}', [ClinicController::class, 'update'])->name('clinics.update');
    Route::delete('/clinics/{clinic}', [ClinicController::class, 'destroy'])->name('clinics.destroy');

    Route::get('/medical_records', [MedicalRecordController::class, 'index'])->name('medical_records.index');
    Route::get('/medical_records/create', [MedicalRecordController::class, 'create'])->name('medical_records.create');
    Route::post('/medical_records', [MedicalRecordController::class, 'store'])->name('medical_records.store');
    Route::get('/medical_records/{medicalRecord}', [MedicalRecordController::class, 'show'])->name('medical_records.show');
    Route::get('/medical_records/{medicalRecord}/edit', [MedicalRecordController::class, 'edit'])->name('medical_records.edit');
    Route::put('/medical_records/{medicalRecord}', [MedicalRecordController::class, 'update'])->name('medical_records.update');
    Route::delete('/medical_records/{medicalRecord}', [MedicalRecordController::class, 'destroy'])->name('medical_records.destroy');

    Route::get('/lab_tests', [LabTestController::class, 'index'])->name('lab_tests.index');
    Route::get('/lab_tests/create', [LabTestController::class, 'create'])->name('lab_tests.create');
    Route::post('/lab_tests', [LabTestController::class, 'store'])->name('lab_tests.store');
    Route::get('/lab_tests/{labTest}', [LabTestController::class, 'show'])->name('lab_tests.show');
    Route::get('/lab_tests/{labTest}/edit', [LabTestController::class, 'edit'])->name('lab_tests.edit');
    Route::put('/lab_tests/{labTest}', [LabTestController::class, 'update'])->name('lab_tests.update');
    Route::delete('/lab_tests/{labTest}', [LabTestController::class, 'destroy'])->name('lab_tests.destroy');
    // Authenticate Lab Tests
    Route::post('/lab_tests/{labTest}/authenticate', [LabTestController::class, 'authenticate'])->name('lab_tests.authenticate');

    Route::get('/medical_diagnoses', [MedicalDiagnosisController::class, 'index'])->name('medical_diagnoses.index');
    Route::get('/medical_diagnoses/create', [MedicalDiagnosisController::class, 'create'])->name('medical_diagnoses.create');
    Route::post('/medical_diagnoses', [MedicalDiagnosisController::class, 'store'])->name('medical_diagnoses.store');
    Route::get('/medical_diagnoses/{medicalDiagnosis}', [MedicalDiagnosisController::class, 'show'])->name('medical_diagnoses.show');
    Route::get('/medical_diagnoses/{medicalDiagnosis}/edit', [MedicalDiagnosisController::class, 'edit'])->name('medical_diagnoses.edit');
    Route::put('/medical_diagnoses/{medicalDiagnosis}', [MedicalDiagnosisController::class, 'update'])->name('medical_diagnoses.update');
    Route::delete('/medical_diagnoses/{medicalDiagnosis}', [MedicalDiagnosisController::class, 'destroy'])->name('medical_diagnoses.destroy');

    Route::get('/drugs', [DrugController::class, 'index'])->name('drugs.index');
    Route::get('/drugs/create', [DrugController::class, 'create'])->name('drugs.create');
    Route::post('/drugs', [DrugController::class, 'store'])->name('drugs.store');
    Route::get('/drugs/{drug}', [DrugController::class, 'show'])->name('drugs.show');
    Route::get('/drugs/{id}/edit', [DrugController::class, 'edit'])->name('drugs.edit');
    Route::delete('/drugs/{id}', [DrugController::class, 'destroy'])->name('drugs.destroy');
    Route::put('/drugs/{drug}', [DrugController::class, 'update'])->name('drugs.update');

    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/prescriptions/{prescription}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
    Route::put('/prescriptions/{prescription}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
    Route::delete('/prescriptions/{prescription}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    Route::get('/audit_logs', [AuditLogController::class, 'index'])->name('audit_logs.index');
    Route::get('/audit_logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit_logs.show');

    // api playground
    Route::get('/api_playground', [ApiPlaygroundController::class, 'system_apis'])->name('api_list');
    Route::post('/api/request', [ApiPlaygroundController::class, 'handleApiRequest'])->name('api.playground.handle');

});

// Begin pest test routes
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index.pest');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create.pest');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store.pest');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show.pest');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit.pest');
Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update.pest');
Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy.pest');
Route::get('/patients/trashed/temp', [PatientController::class, 'trashed'])->name('patients.trashed.pest');
Route::post('/patients/trashed/temp/{id}/restore', [PatientController::class, 'restore'])->name('patients.restore.pest');
Route::post('/patients/trashed/temp/restore-all', [PatientController::class, 'restoreAll'])->name('patients.restoreAll.pest');
// End pest test routes
