<?php

use Illuminate\Support\Facades\Route;;

use App\Http\Controllers\V1\{
    PatientController,
    DiagnoseController,
    PatientDiagnoseController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('diagnoses', DiagnoseController::class);


Route::controller(PatientController::class)->prefix('patients')->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search');
    Route::post('/', 'store');
    Route::get('/{patient}', 'show');
    Route::get('/{patient}', 'show');
    Route::put('/{patient}', 'update');
    Route::delete('/{patient}', 'destroy');
});

Route::controller(PatientDiagnoseController::class)->prefix('patient_diagnoses')->group(function () {
    Route::get('/', 'index');
    Route::get('/most-common', 'getMostCommonInLastSixMonths');
    Route::post('/', 'store');
    Route::get('/{patient_diagnose}', 'show');
    Route::put('/{patient_diagnose}', 'update');
    Route::delete('/{patient_diagnose}', 'destroy');
});
