<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
  public function sendLanguage(Request $request)
  {
    try{

    $putLanguage = $request->input('language', 'it');
    var_dump("LC->BeforePut->",$putLanguage);
    session(['language' => $putLanguage]);
    $value = session('language');
    var_dump("LC->AfterGet->", $value);

    // Construye la nueva URL con el idioma actual
    $newUrl = route('home', ['language' => $putLanguage]);

    return response()->json(['success' => true, 'newUrl' => $newUrl]);
  }catch(\Exception $e){
    var_dump("Aqui llegué languageController");
     return response()->json(['error' => $e->getMessage()], 501);
  }
}

}
