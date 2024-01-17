<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DigitizationController;
use App\Http\Controllers\ConsultancyController;
use App\Http\Controllers\BiitController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Session;

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
// explorar esta via...
$language = Session::get('language', env('FALLBACK_LOCALE', 'es')); // 'es' es el valor predeterminado

Route::post('/set-language', [LanguageController::class, 'changeLanguage']);

// Route::middleware(['LanguageRedirect'])->group(function () {
  Route::prefix('/{language?}')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    // Route::get('/#{section?}', [HomeController::class, 'homeSection'])->name('home.section');
    // Route::get('/home#{section?}', [HomeController::class, 'homeSection'])->name('home.section');

    Route::get('/consultoria', [ConsultancyController::class, 'consultoria'])->name('consultoria');
    // Route::get('/consultoria#{section?}', [ConsultancyController::class, 'consultoriaSection'])->name('consultoria.section');

    Route::get('/digitalizacion', [DigitizationController::class, 'digitalizacion'])->name('digitalizacion');
    // Route::get('/digitalizacion#{section?}', [DigitizationController::class, 'digitalizacionSection'])->name('digitalizacion.section');

    Route::get('/biit', [BiitController::class, 'biit'])->name('biit');
    // Route::get('/biit#{section?}', [BiitController::class, 'biitSection'])->name('biit.section');

    Route::get('/whyBiit', [BiitController::class, 'whyBiit'])->name('whyBiit');
    // Route::get('/whyBiit#{section?}', [BiitController::class, 'whyBiitSection'])->name('whyBiit.section');

    Route::get('/biitModules', [BiitController::class, 'biitModules'])->name('biitModules');
    // Route::get('/biitModules#{section?}', [BiitController::class, 'biitModulesSection'])->name('biitModules.section');

    Route::get('/biitContact', [BiitController::class, 'biitContact'])->name('biitContact');

    Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

    Route::get('/termsOfUse', [HomeController::class, 'termsOfUse'])->name('termsOfUse');
  });
// });
