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
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('indexRegister');
// Route::post('/register', 'Auth\RegisterController@register');
// Route::get('/login', 'Auth\LoginController@showLoginForm');
// Route::post('/login', 'Auth\LoginController@login');
// Old version ->
// Route::get('/register', function () {
// 	$language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/register");
// });
// Route::post('/register', function () {
//     $language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/register");
// })->name('indexRegister');

// Route::get('/login', function () {
//     $language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/login");
// });
// Route::post('/login', function () {
//     $language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/login");
// })->name('indexLogin');

// // Route::post('/logout', 'Auth\LoginController@logout');
// Route::post('/logout', function () {
//     $language = session('language', config('app.fallback_locale', 'ca'));
//     return Redirect::to("/$language/logout");
// })->name('indexLogout');


Route::get('/register', function () {
    return Redirect::to("/" . app()->getLocale() . "/register");
});
Route::post('/register', function () {
    return Redirect::to("/" . app()->getLocale() . "/register");
})->name('indexRegister');

Route::get('/login', function () {
    return Redirect::to("/" . app()->getLocale() . "/login");
});
Route::post('/login', function () {
    return Redirect::to("/" . app()->getLocale() . "/login");
})->name('indexLogin');

Route::post('/logout', function () {
    return Redirect::to("/" . app()->getLocale() . "/logout");
})->name('indexLogout');

Route::get('/password/reset', function () {
	return Redirect::to("/" . app()->getLocale() . "/password/reset");
})->name('indexPasswordRequest');
Route::post('/password/email', function () {
	return Redirect::to("/" . app()->getLocale() . "/password/email");
})->name('indexPasswordEmail');
Route::get('/password/reset/{token}', function () {
	return Redirect::to("/" . app()->getLocale() . "/password/reset/{token}");
})->name('indexPasswordRequestToken');
Route::post('/password/reset', function () {
	return Redirect::to("/" . app()->getLocale() . "/password/reset");
})->name('indexPasswordRequestPost');
Route::get('/password/confirm', function () {
	return Redirect::to("/" . app()->getLocale() . "/password/confirm");
})->name('indexShowConfirmForm');
Route::post('/password/confirm', function () {
	return Redirect::to("/" . app()->getLocale() . "/password/confirm");
})->name('indexPasswordConfim');


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
