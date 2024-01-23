<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactConfirmation;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

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

        var_dump($messages);
        Mail::to('albert.vabe@gmail.com')->send(new ContactMessage($messages));

         Mail::to($request->input('email'))->send(new ContactConfirmation($messages));

        // Mail::to($request->input('email'))->send(new AutoReplyMessage());


        // return back()->with('success', 'Mensaje enviado con exito!');

        return view('biitContact', ['language' => $language])->with('success', 'Mensaje enviado con exito!');
    }
}
