<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BiitController extends Controller
{
    public function biit()
    {
       $language = Session::get('language', 'ko');

        return view('biit', ['language' => $language]);
    }

    public function biitSection($section = null)
    {

       $language = Session::get('language', 'ko');
        return view('biit', ['section' => $section, 'language' => $language]);
    }

     public function whyBiit()
    {
       $language = Session::get('language', 'ko');
        return view('whyBiit', ['language' => $language]);
    }

    public function whyBiitSection($section = null)
    {
       $language = Session::get('language', 'ko');
        return view('whyBiit', ['section' => $section, 'language' => $language]);
    }

    public function biitModules()
    {
       $language = Session::get('language', 'ko');
        return view('biitModules', ['language' => $language]);
    }

    public function biitModulesSection($section = null)
    {
       $language = Session::get('language', 'ko');
        return view('biitModules', ['section' => $section, 'language' => $language]);
    }

    public function biitContact()
    {
       $language = Session::get('language', 'ko');
        return view('biitContact', ['language' => $language]);
    }
}
