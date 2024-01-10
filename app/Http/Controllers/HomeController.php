<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
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
