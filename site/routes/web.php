<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DepartureController;
use App\Http\Controllers\PlomesalmarController;
use App\Http\Controllers\GraphController; 


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

// Route::get('/dictionary/{language}/{page}.json', [LanguageController::class, 'load'])->middleware('auth');

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

Route::get('/test', function () {
    return 'GraphController is working';
})->name('testGraph');


Route::get('/{language?}/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homeLanguage');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'homeMain'])->name('homeMain');
Route::get('/', [App\Http\Controllers\HomeController::class, 'slashMain'])->name('slashMain');

Route::post('/sendLanguage', [LanguageController::class, 'sendLanguage']);
Route::post('/plomesalmarContact', [PlomesalmarController::class, 'plomesalmarContactSubmit'])->name('plomesalmarContact.submit');


Route::prefix('/{language?}')->group(function () {
	Auth::routes();

	// A la ruta admin? ->middleware('auth')
	Route::prefix('admin')->group(function () {
		Route::get('management', [AdminController::class, 'index'])->name('admin.index');
		Route::get('users', [AdminController::class, 'userList'])->name('admin.users');
		Route::get('user/{user}/details', [AdminController::class, 'userShow'])->name('admin.user.details');
		Route::post('role', [AdminController::class, 'setRole'])->name('admin.user.setRole');
		Route::delete('role', [AdminController::class, 'removeRole'])->name('admin.user.removeRole');
	});

	Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/#{section?}', [HomeController::class, 'indexSection'])->name('index.section');
    Route::get('/home#{section?}', [HomeController::class, 'homeSection'])->name('home.section');

	Route::get('/plomesalmarContact', [PlomesalmarController::class, 'plomesalmarContactForm'])->name('plomesalmarContact');
    // Route::post('/plomesalmarContact', [PlomesalmarController::class, 'plomesalmarContactSubmit'])->name('plomesalmarContact.submit');

	Route::get('/management', [HomeController::class, 'management'])->name('management');
	Route::get('/dashboard', [GraphController::class, 'index'])->name('dashboard');

    // Rutas Espécies
    Route::resource('species', SpecieController::class)->except(['index']);
	Route::get('/species', [SpecieController::class, 'index'])->name('species');

    //Rutas Barcos
    Route::resource('boats', BoatController::class)->except(['index']);
	Route::get('/boats', [BoatController::class, 'index'])->name('boats');

    //Rutas Salidas
    Route::resource('departures', DepartureController::class)->except(['index']);
	Route::get('/departures', [DepartureController::class, 'index'])->name('departures');

    Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
    Route::get('/termsOfUse', [HomeController::class, 'termsOfUse'])->name('termsOfUse');
});

// Route::fallback([HomeController::class, 'index']);
