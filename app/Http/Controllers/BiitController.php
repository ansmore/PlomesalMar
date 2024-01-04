<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiitController extends Controller
{
    public function biit()
    {
        return view('biit');
    }

    public function biitSection($section = null)
    {
        return view('biit', ['section' => $section]);
    }

     public function whyBiit()
    {
        return view('whyBiit');
    }

    public function whyBiitSection($section = null)
    {
        return view('whyBiit', ['section' => $section]);
    }

    public function biitModules()
    {
        return view('biitModules');
    }

    public function biitModulesSection($section = null)
    {
        return view('biitModules', ['section' => $section]);
    }

    public function biitContact()
    {
        return view('biitContact');
    }
}
