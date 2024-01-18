<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      try {
        // seguir provant aqui!!!!
        // dd("aqui middleware");
        // echo '<pre>';

        $segment = $request->segment(1);
        var_dump("Segmemnt middleware", $segment);

        // echo "\\n";

        // $jsonData = $request->json()->all();
        // var_dump("Aqui->Json-> ",$jsonData);

        // $segment = 'ru';
        // $lang = Session::get('language', env('FALLBACK_LOCALE', 'kin')); // 'es' es el valor predeterminado
        // var_dump("middleware after get", $lang);

        // var_dump("Available_locales", config('app.available_locales'));
        // echo '</pre>';

        // dd("Segment: ", $segment, "Available Locales: ", config('app.available_locales'));


        // Verificar si ya hay un idioma en la URL
        // if ($segment && !in_array($segment, config('app.available_locales'))) {

        //   $fallbackLocale = config('app.fallback_locale', 'ca');

        //   // Verificar si el idioma predeterminado está en la lista de idiomas disponibles
        //   $language = in_array($fallbackLocale, config('app.available_locales')) ? $fallbackLocale : 'es';

        //   // // Construir la URL de redirección correctamente
        //   // $redirectUrl = "/$language" . ($request->getPathInfo() == '/' ? '' : '/' . ltrim($request->getPathInfo(), '/'));

        //   // Construir la URL de redirección correctamente
        //   $redirectUrl = "/$language" . $request->getPathInfo();


        //   return redirect()->to($redirectUrl);
        // }
        // dd($next($request));

        return $next($request);
      }
      catch (\Exception $exception) {
        // Manejar la excepción, por ejemplo, imprimir un mensaje de error
        dd("Error en la ejecución del siguiente middleware o controlador: " . $exception->getMessage());
    }
}
}
