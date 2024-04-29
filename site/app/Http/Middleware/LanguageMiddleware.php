<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Intenta obtener el idioma desde la sesión o usa el idioma predeterminado
        $language = session('language', config('app.fallback_locale', 'ca'));

        // Configura el idioma de la aplicación
        app()->setLocale($language);

        // Comparte el idioma con todas las vistas
        View::share('language', $language);

        // Log the current language and other request details
        Log::channel('language_middleware')->info('Setting language', [
            'language' => $language,
            'session_language' => session('language'),
            'fallback_locale' => config('app.fallback_locale'),
            'url' => $request->url(),
            'ip' => $request->ip()
        ]);

        // Continue with the request
        return $next($request);
    }
}
