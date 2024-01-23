<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Mail\ContactConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BiitController extends Controller
{
    public function biit()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('biit', ['language' => $language]);
    }

    public function biitSection($section = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('biit', ['section' => $section, 'language' => $language]);
    }

    public function whyBiit()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('whyBiit', ['language' => $language]);
    }

    public function whyBiitSection($section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('whyBiit', ['section' => $section, 'language' => $language]);
    }

    public function biitModules()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('biitModules', ['language' => $language]);
    }

    public function biitModulesSection($section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('biitModules', ['section' => $section, 'language' => $language]);
    }

    public function biitContactForm()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('biitContact', ['language' => $language]);
    }


    public function biitContactSubmit(Request $request)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        // Validar el formulario si es necesario
       $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mailsubject' => 'required',
            'message' => 'required',

        ]);

        // Obtener los datos del formulario
        $messages = new \stdClass();
        $messages->name = $request->name;
        $messages->email = $request->email;
        $messages->mailsubject = $request->mailsubject;
        $messages->message = $request->message;

        // $dictionaryPath = base_path("./../dictionary/{$language}/{$language}_emails.json");

        $dictionaryPath = base_path("public/dictionary/{$language}/{$language}_emails.json");

        if(File::exists($dictionaryPath)){
            $dictionary = json_decode(File::get($dictionaryPath), true);
        }else {
            // Manejar el caso donde el archivo del diccionario no existe
            $dictionary = [];
        }


        // dd("contenido diccionario", $dictionary);

        Mail::to('albert.vabe@gmail.com')->send(new ContactMessage($messages));

        Mail::to($request->input('email'))->send(new ContactConfirmation($messages, $dictionary));

        return view('biitContact', ['language' => $language])->with('success', 'Mensaje enviado con exito!');
    }
}
