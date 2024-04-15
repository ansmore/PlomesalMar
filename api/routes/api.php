<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\BoatController;
use App\Http\Controllers\V1\RolsController;
use App\Http\Controllers\V1\UsersController;
use App\Http\Controllers\V1\ImagesController;
use App\Http\Controllers\V1\SpecieController;
use App\Http\Controllers\V1\TransectController;
use App\Http\Controllers\V1\DepartureController;
use App\Http\Controllers\V1\ObservationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('V1')->group(function () {
    // Rutas para Species
    Route::get('/species', [SpecieController::class, 'index']);
    Route::get('/species/{id}', [SpecieController::class, 'show']);

    // Rutas para Boats
    Route::get('/boats', [BoatController::class, 'index']);
    Route::post('/boats', [BoatController::class, 'store']);
    Route::get('/boats/{id}', [BoatController::class, 'show']);

    // Rutas para Transects
    Route::get('/transects', [TransectController::class, 'index']);
    Route::post('/transects', [TransectController::class, 'store']);
    Route::get('/transects/{id}', [TransectController::class, 'show']);

    // Rutas para Users
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::get('/users/{id}', [UsersController::class, 'show']);

    // Routas para Roles
    Route::get('/roles', [RolsController::class, 'index']);
    Route::post('/roles', [RolsController::class, 'store']);
    Route::get('/roles/{id}', [RolsController::class, 'show']);

    // Rutas para Departures
    Route::get('/departures', [DepartureController::class, 'index']);
    Route::post('/departures', [DepartureController::class, 'store']);
    Route::get('/departures/{id}', [DepartureController::class, 'show']);

    // Rutas para Observations
    Route::get('/observations', [ObservationController::class, 'index']);
    Route::get('/observations/{id}', [ObservationController::class, 'show']);

    // Rutas para Images
    Route::get('/images', [ImagesController::class, 'index']);
    Route::get('/images/{id}', [ImagesController::class, 'show']);
});

