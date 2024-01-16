<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
      $language = Session::get('language', 'pt1'); // 'es' es el valor predeterminado
      var_dump("after get->",$language);


        return view('home', ['language' => $language]);
    }

    public function homeSection($language = null, $section = null)
    {
        return view('home', ['section' => $section, 'language' => $language]);
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
