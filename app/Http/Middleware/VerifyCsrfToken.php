<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/sendLanguage', // Añade tu ruta aquí
        '/biitContact',
        '/es/biitContact',
        '/en/biitContact',
        '/ca/biitContact',
        '/{ca,en,es}/biitContact',

    ];
}
