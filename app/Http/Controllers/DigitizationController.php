<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DigitizationController extends Controller
{
    public function digitalizacion()
    {
        return view('digitalizacion');
    }

    public function digitalizacionSection($section = null)
    {
        return view('digitalizacion', ['section' => $section]);
    }
}
