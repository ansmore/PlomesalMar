<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
		$language = Session::get('language',  config('app.fallback_locale', 'ca'));

        if (! $request->expectsJson()) {
            return route('login', [
                            'language' => $language,
                        ]);
        }
    }
}
