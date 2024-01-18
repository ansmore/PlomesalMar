<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
  public function sendLanguage(Request $request)
  {
    // dd("Aqui get l");
    try{
    $putLanguage = $request->input('language', 'it');
    // $language = "aqui no";
    // dd("changeLanguage", $language);
    var_dump("LC->BeforePut->",$putLanguage);
    Session::put('language', $putLanguage);
    $getLanguage = Session::get('language', env('FALLBACK_LOCALE', 'es'));
    var_dump("LC->AfterGet->",$getLanguage);
    dd();
    return response()->json(['success' => true]);
  }catch(\Exception $e){
    var_dump("Aqui llegué languageController");
     return response()->json(['error' => $e->getMessage()], 501);
  }
}

}
