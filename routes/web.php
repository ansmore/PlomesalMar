<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\BirdsController;
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

// $language = Session::get('language',  config('app.fallback_locale', 'ca'));

// Auth::routes();


// Routes intent 1
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'indexLogin'])->name('indexLogin');
// Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'indexRegister'])->name('indexRegister');
// Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'indexForgotPassword'])->name('indexForgotPassword');


// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('indexRegister');
Route::get('/register', function () {
    $language = session('language', config('app.fallback_locale', 'ca'));
    return Redirect::to("/$language/register");
});
// Route::post('/register', 'Auth\RegisterController@register');
Route::post('/register', function () {
    $language = session('language', config('app.fallback_locale', 'ca'));
    return Redirect::to("/$language/register");
})->name('indexRegister');

// Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/login', function () {
    $language = session('language', config('app.fallback_locale', 'ca'));
    return Redirect::to("/$language/login");
});
// Route::post('/login', 'Auth\LoginController@login');
Route::post('/login', function () {
    $language = session('language', config('app.fallback_locale', 'ca'));
    return Redirect::to("/$language/login");
})->name('indexLogin');
Route::post('/logout', 'Auth\LoginController@logout');
// Route::post('/logout', function () {
//     $language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/logout");
// });

// Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('/password/confirm', 'Auth\ConfirmPasswordController@confirm');


// Route::redirect('/patata', '/$language/login');
// Route::get('/patata', function () {
//     $language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/register");
// });

// Route::view('/pilota', 'auth.login');


Route::get('/{language?}/home', [App\Http\Controllers\homeController::class, 'index'])->name('homeLanguage');
Route::get('/home', [App\Http\Controllers\homeController::class, 'homeMain'])->name('homeMain');
Route::get('/', [App\Http\Controllers\homeController::class, 'slashMain'])->name('slashMain');

Route::post('/sendLanguage', [LanguageController::class, 'sendLanguage']);
Route::post('/birdsContact', [BirdsController::class, 'birdsContactSubmit'])->name('birdsContact.submit');


Route::prefix('/{language?}')->group(function () {
	Auth::routes();

	Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/#{section?}', [HomeController::class, 'indexSection'])->name('index.section');
    Route::get('/home#{section?}', [HomeController::class, 'homeSection'])->name('home.section');

	Route::get('/birdsContact', [BirdsController::class, 'birdsContactForm'])->name('birdsContact');
    // Route::post('/birdsContact', [BirdsController::class, 'birdsContactSubmit'])->name('birdsContact.submit');

    Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

    Route::get('/termsOfUse', [HomeController::class, 'termsOfUse'])->name('termsOfUse');
});

// Route::fallback([HomeController::class, 'index']);
