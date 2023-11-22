<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DigitizationController;
use App\Http\Controllers\ConsultancyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/#{section?}', [HomeController::class, 'homeSection'])->name('home.section');

Route::get('/consultoria', [ConsultancyController::class, 'consultoria'])->name('consultoria');
Route::get('/consultoria#{section?}', [ConsultancyController::class, 'consultoriaSection'])->name('consultoria.section');

Route::get('/digitalizacion', [DigitizationController::class, 'digitalizacion'])->name('digitalizacion');
Route::get('/digitalizacion#{section?}', [DigitizationController::class, 'digitalizacionSection'])->name('digitalizacion.section');
