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

        $language = Session::get('language', env('FALLBACK_LOCALE', 'es'));

        $fallbackLocale = config('app.fallback_locale', 'es');
        $defaultLanguage = in_array($language, config('app.available_locales')) ? $language : $fallbackLocale;
        // "/$defaultLanguage/home"
        return Redirect::to("/home");
    }

    public function home($language = null)
    {
        // var_dump("HomeControl Before put->",$language, "\n");
        // // Si se proporciona un valor en la URL, establecerlo en la sesión
        // if ($language) {
        //   // se puede modificar
        //   $language= "pt";
        //     Session::put('language', $language);
        // }

        // // Obtener el valor de la variable 'language' de la sesión
        // $language = Session::get('language', env('FALLBACK_LOCALE', 'es')); // 'es' es el valor predeterminado
        // var_dump("HomeController After get->",$language, "\n");

        //   // , ['language' => $language]
          return view('home');
    }

    public function homeSection($language = null, $section = null)
    {
        // if ($language) {
        //   // se puede modificar
        //   // $language= "prova";
        //     Session::put('language', $language);
        // }

        // // Obtener el valor de la variable 'language' de la sesión
        // $language = Session::get('language', env('FALLBACK_LOCALE', 'es')); // 'es' es el valor predeterminado

        return view('home', ['section' => $section]);
    }

    public function privacyPolicy($language = null)
    {

        $language = Session::get('language', env('FALLBACK_LOCALE', 'es'));

        return view('privacyPolicy',['language' => $language]);
    }

    public function termsOfUse()
    {
        return view('termsOfUse');
    }
}
