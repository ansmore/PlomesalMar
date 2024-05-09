<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class IsBlocked
{

    protected $allowed = ['contact.form', 'contact.email', 'home.blocked', 'logout'];

    // Desbloquejar la portada => home.welcome

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $route = Route::currentRouteName();

        if($user && $user->hasRole('bloquejat') && !in_array($route, $this->allowed))
            return redirect()->route('home.blocked');

        return $next($request);
    }
}
