<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use App\Mail\ContactConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PlomesalmarController extends Controller
{
    public function plomesalmar()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.plomesalmar', ['language' => $language]);
    }

    public function plomesalmarSection($section = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.plomesalmar', ['section' => $section, 'language' => $language]);
    }

    public function plomesalmarContactForm()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.plomesalmarContact', ['language' => $language]);
    }


    public function plomesalmarContactSubmit(Request $request)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

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

        Mail::to(env('MAIL_FROM_ADDRESS', 'avalls89@gmail.com'))->send(new ContactMessage($messages, $dictionary));

        Mail::to($request->input('email'))->send(new ContactConfirmation($messages, $dictionary));

        return view('pages.plomesalmarContact', ['language' => $language])->with('success', 'Mensaje enviado con exito!');
    }
}
