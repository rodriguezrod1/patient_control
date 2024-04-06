<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\V1\{
    MedicalHistoryController,
    ZoneController,
    ProcedureController,
    ConsultationController
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

Route::get('/login', function () {
    return response()->json(['error' => 'Unauthenticated.'],  401);
})->name('login');


// GUEST Routers
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// AUTH Routers
Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // ================== CLIENT WEB ROUTERS ================== //




    // ================== ADMIN ROUTERS ================== //


    Route::controller(ConsultationController::class)->prefix('consultations')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}/zone', 'listAllByZoneId');
        Route::get('/{consultation}', 'show');
        Route::put('/{consultation}', 'update');
        Route::delete('/{consultation}', 'destroy');
    });


    Route::controller(MedicalHistoryController::class)->prefix('medical_historys')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}/procedure', 'listAllByProcedurestId');
        Route::get('/{medical_history}', 'show');
        Route::put('/{medical_history}', 'update');
        Route::delete('/{medical_history}', 'destroy');
    });


    Route::controller(ProcedureController::class)->prefix('procedures')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{id}/zone', 'listAllByZonetId');
        Route::get('/{procedure}', 'show');
        Route::put('/{procedure}', 'update');
        Route::delete('/{procedure}', 'destroy');
    });


    Route::controller(ZoneController::class)->prefix('zones')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{zone}', 'show');
        Route::put('/{zone}', 'update');
        Route::delete('/{zone}', 'destroy');
    });
});
