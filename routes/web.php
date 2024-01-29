<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BiitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ConsultancyController;
use App\Http\Controllers\DigitizationController;

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
// $language = Session::get('language', 'rus'); // 'es' es el valor predeterminado

Route::get('/confirmation', function () {
      $language = Session::get('language',  config('app.fallback_locale', 'es'));

    $dictionaryPath = base_path("public/dictionary/{$language}/{$language}_emails.json");

    if (File::exists($dictionaryPath)) {
        $dictionary = json_decode(File::get($dictionaryPath), true);
    } else {
        $dictionary = [];
    }

    $messages = new \stdClass();
    // Puedes establecer valores predeterminados para las variables necesarias
    $messages->name = 'Nombre de ejemplo';
    $messages->email = 'correo@example.com';
    $messages->mailsubject = 'Asunto de ejemplo';
    $messages->message = 'Mensaje de ejemplo';

    return view('emails.contactConfirmation', compact('messages', 'dictionary'));
});

Route::post('/sendLanguage', [LanguageController::class, 'sendLanguage']);
Route::post('/biitContact', [BiitController::class, 'biitContactSubmit'])->name('biitContact.submit');

Route::prefix('/{language?}')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/#{section?}', [HomeController::class, 'indexSection'])->name('index.section');
    Route::get('/home#{section?}', [HomeController::class, 'homeSection'])->name('home.section');

    Route::get('/consultoria', [ConsultancyController::class, 'consultoria'])->name('consultoria');
    Route::get('/consultoria#{section?}', [ConsultancyController::class, 'consultoriaSection'])->name('consultoria.section');

    Route::get('/digitalization', [DigitizationController::class, 'digitalization'])->name('digitalization');
    Route::get('/digitalization#{section?}', [DigitizationController::class, 'digitalizationSection'])->name('digitalization.section');

    Route::get('/biit', [BiitController::class, 'biit'])->name('biit');
    Route::get('/biit#{section?}', [BiitController::class, 'biitSection'])->name('biit.section');

    Route::get('/whyBiit', [BiitController::class, 'whyBiit'])->name('whyBiit');
    Route::get('/whyBiit#{section?}', [BiitController::class, 'whyBiitSection'])->name('whyBiit.section');

    Route::get('/biitModules', [BiitController::class, 'biitModules'])->name('biitModules');
    Route::get('/biitModules#{section?}', [BiitController::class, 'biitModulesSection'])->name('biitModules.section');

    Route::get('/biitContact', [BiitController::class, 'biitContactForm'])->name('biitContact');
    // Route::post('/biitContact', [BiitController::class, 'biitContactSubmit'])->name('biitContact.submit');

    Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

    Route::get('/termsOfUse', [HomeController::class, 'termsOfUse'])->name('termsOfUse');
});



Route::fallback([HomeController::class, 'index']);
