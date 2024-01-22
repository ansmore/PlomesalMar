<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return Redirect::to("/$language/home");
    }

    public function home($language = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('home', ['language' => $language]);
    }

    public function homeSection($language = null, $section = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('home', ['section' => $section,'language' => $language ]);
    }

    public function privacyPolicy($language = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('privacyPolicy',['language' => $language]);
    }

    public function termsOfUse()
    {

        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('termsOfUse',['language' => $language]);
    }
}
