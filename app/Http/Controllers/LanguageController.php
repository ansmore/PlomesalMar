<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
  public function changeLanguage(Request $request)
  {
    try{
    $language = $request->input('language', 'pt2');
    // $language = "aqui no";
    Session::put('language', $language);
    var_dump("request->",$request);
    var_dump("language->",$language);
    dd();
    return response()->json(['success' => true]);
  }catch(\Exception $e){
    var_dump("Aqui llegué languageController");
     return response()->json(['error' => $e->getMessage()], 500);
  }
}

}
