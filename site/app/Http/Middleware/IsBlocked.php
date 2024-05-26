<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class IsBlocked
{

    protected $allowed = ['plomesalmarContact', 'plomesalmarContact.submit', 'indexBlocked', 'blocked', 'logout', 'sendLanguade'];

    // Desbloquejar la portada => home.welcome

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		$language = Session::get('language',  config('app.fallback_locale', 'ca'));

        $user = $request->user();
        $route = Route::currentRouteName();

        if($user && $user->hasRole('blocked') && !in_array($route, $this->allowed))
            return redirect()->route('blocked', [
                        'language' => $language,
                    ]);

        return $next($request);
    }
}
