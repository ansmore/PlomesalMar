<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home($language = null)
    {
      // Si se proporciona un valor en la URL, establecerlo en la sesión
      if ($language) {
          Session::put('language', $language);
      }

       // Obtener el valor de la variable 'language' de la sesión
        $language = Session::get('language', 'asfaafs'); // 'es' es el valor predeterminado
        var_dump($language);

        return view('home',  compact('language'));
    }

    public function homeSection($section = null)
    {
        return view('home', ['section' => $section]);
    }

    public function privacyPolicy()
    {
        return view('privacyPolicy');
    }

    public function termsOfUse()
    {
        return view('termsOfUse');
    }
}
