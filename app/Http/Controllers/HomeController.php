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
      // $fallbackLocale = config('app.fallback_locale', 'es');
      // $defaultLanguage = in_array($language, config('app.available_locales')) ? $language : $fallbackLocale;
      // // "/$defaultLanguage/home"


        $language = Session::get('language',  'tu');

        return Redirect::to("/$language/home");
    }

    public function home($language = null)
    {
        if (!$language) {
            return "No hay idioma en los parámetros.";
        }
      // Si se proporciona un valor en la URL, establecerlo en la sesión
        if ($language) {
            Session::put('language', $language);
        }

        // var_dump("HomeControl Before put->",$language, "\n");

        // Obtener el valor de la variable 'language' de la sesión
        $language = Session::get('language', 'ko');
        // var_dump("HomeController After get->",$language, "\n");

        return view('home', ['language' => $language]);
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
