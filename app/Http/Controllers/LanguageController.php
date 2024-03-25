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
        // Set language fron Request of file JSON
        $putLanguage = $request->input('language', config('app.fallback_locale', 'ca'));
        $putPage = $request->input('fileName', 'home');

        Session::put('language', $putLanguage);
        $getLanguage = session('language');

        // Construye la nueva URL con el idioma actual
        $newUrl = route($putPage, ['language' => $getLanguage]);

        return response()->json(['success' => true, 'newUrl' => $newUrl, 'fileName'=> $putPage, ]);
        }catch(\Exception $e){
        var_dump("Aqui llegué languageController");
        return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
