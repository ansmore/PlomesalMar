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
        '/sendLanguage',
        '/es/plomesalmarContact',
        '/en/plomesalmarContact',
        '/ca/plomesalmarContact',
        '/{ca,en,es}/plomesalmarContact',
        'en/dashboard/multiGraph',
        'en/dashboard/graph1',
        'en/dashboard/donutGraph',
    ];
}
