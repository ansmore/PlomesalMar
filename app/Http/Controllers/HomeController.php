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

        return Redirect::to("/$defaultLanguage/home");
    }

    public function home($language = null)
    {
        var_dump("Before->",$language);
        // Si se proporciona un valor en la URL, establecerlo en la sesión
        if ($language) {
          // se puede modificar
          // $language= "prova";
            Session::put('language', $language);
        }

        // Obtener el valor de la variable 'language' de la sesión
        $language = Session::get('language', env('FALLBACK_LOCALE', 'es')); // 'es' es el valor predeterminado
        var_dump("after get->",$language);


          return view('home', ['language' => $language]);
    }

    public function homeSection($language = null, $section = null)
    {
        if ($language) {
          // se puede modificar
          // $language= "prova";
            Session::put('language', $language);
        }

        // Obtener el valor de la variable 'language' de la sesión
        $language = Session::get('language', env('FALLBACK_LOCALE', 'es')); // 'es' es el valor predeterminado

        return view('home', ['section' => $section, 'language' => $language]);
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
