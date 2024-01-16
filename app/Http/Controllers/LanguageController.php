<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
  public function changeLanguage(Request $request)
  {
    $language = $request->input('language', 'prueba');

    Session::put('selectedLanguage', $language);
    var_dump($request);
    return response()->json(['success' => true]);
  }
}
