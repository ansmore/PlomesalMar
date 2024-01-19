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
        $language = Session::get('language',  'tu');

        return Redirect::to("/$language/home");
    }

    public function home($language = null)
    {
        if ($language) {
            Session::put('language', $language);
        }

        $language = Session::get('language', 'ko');

        return view('home', ['language' => $language]);
    }

    public function homeSection($language = null, $section = null)
    {

        $language = Session::get('language', 'ka');

        return view('home', ['section' => $section,'language' => $language ]);
    }

    public function privacyPolicy($language = null)
    {
   $language = Session::get('language', 'ki');


        return view('privacyPolicy',['language' => $language]);
    }

    public function termsOfUse()
    {

         $language = Session::get('language', 'ko');

        return view('termsOfUse',['language' => $language]);
    }
}
