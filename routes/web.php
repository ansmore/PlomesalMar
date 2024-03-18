<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BirdsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;


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


Route::post('/sendLanguage', [LanguageController::class, 'sendLanguage']);
Route::post('/birdsContact', [BirdsController::class, 'birdsContactSubmit'])->name('birdsContact.submit');

Route::prefix('/{language?}')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/#{section?}', [HomeController::class, 'indexSection'])->name('index.section');
    Route::get('/home#{section?}', [HomeController::class, 'homeSection'])->name('home.section');

       Route::get('/birdsContact', [BirdsController::class, 'birdsContactForm'])->name('birdsContact');
    // Route::post('/birdsContact', [BirdsController::class, 'birdsContactSubmit'])->name('birdsContact.submit');

    Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

    Route::get('/termsOfUse', [HomeController::class, 'termsOfUse'])->name('termsOfUse');
});

Route::fallback([HomeController::class, 'index']);
