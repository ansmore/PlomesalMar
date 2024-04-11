<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

	public function indexForgotPassword($language = null, $section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        // return Redirect::to("/$language/login");
		return view('auth.passwords.reset', ['section' => $section,'language' => $language ]);
    }
}
