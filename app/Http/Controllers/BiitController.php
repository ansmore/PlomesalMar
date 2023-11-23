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
}
