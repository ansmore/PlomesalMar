<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Mockery\Undefined;

class LanguageController extends Controller
{
    public function sendLanguage(Request $request)
    {
        try{
			// Set language fron Request of file JSON
			$setLanguage = $request->input('language', config('app.fallback_locale', 'ca'));
			$setFirstSegment = $request->input('firstSegment', 'home');
			$setSecondSegment = $request->input('secondSegment', '');
			$setIdSegment = $request->input('idSegment', '');
			$setOthersSegments = $request->input('othersSegments', '');

			if ($setFirstSegment == "" || $setFirstSegment == "/") {
				$setFirstSegment = "home";
			}

			// Initialize ordenationString as empty
            $ordenationString = '';
			$ordenationAdmin= '';

            // Check if first segment contains '?'
            if (strpos($setFirstSegment, '?') !== false) {
                list($setFirstSegment, $ordenationString) = explode('?', $setFirstSegment, 2);
            }

			// Check if second segment contains '?'
            if (strpos($setSecondSegment, '?') !== false) {
                list($setSecondSegment, $ordenationAdmin) = explode('?', $setSecondSegment, 2);
            }

			Session::put('language', $setLanguage);
			$getLanguage = session('language');



			if ($setSecondSegment === "") {

				// Construye la nueva URL con el idioma actual
				$newUrl = route($setFirstSegment, ['language' => $getLanguage]);

			} else if($ordenationAdmin !== "") {

				$segments2 = $setFirstSegment.".".$setSecondSegment;

				// Utilitza $newUrl per a construir la ruta final amb el llenguatge
				$newUrl = route($segments2, [
					'language' => $getLanguage
				]);

				Log::channel('language_middleware')->info('concat_admin', [
					'segments2' => $segments2,
					'secondSegment' =>  $setSecondSegment,
					'ordenationAdmin' => $ordenationAdmin,
					'newUrl' => $newUrl,
					'user' => $setIdSegment
				]);

			} else if ($setSecondSegment !== $setOthersSegments) {

				$segments = $setFirstSegment.".".$setSecondSegment.".details";

				// Utilitza $newUrl per a construir la ruta final amb el llenguatge
				$newUrl = route($segments, [
					'language' => $getLanguage,
					'user' => $setIdSegment
				]);

				Log::channel('language_middleware')->info('concat_diferent', [
					'secondSegment' =>  $setSecondSegment,
					'ordenationAdmin' => $ordenationAdmin,
					'newUrl' => $newUrl,
					'segments' => $segments,
					'user' => $setIdSegment
				]);

			}else {
				$segments = $setFirstSegment.".".$setSecondSegment;

				Log::channel('language_middleware')->info('concat_else', [
					'url' => $segments
				]);

				$newUrl = route($segments, [ 'language' => $getLanguage ]);
			}

			Log::channel('language_middleware')->info('Setting language', [
				'language' => $setLanguage,
				'firstSegment' => $setFirstSegment,
				'secondSegment' => $setSecondSegment,
				'idSegment' => $setIdSegment,
				'othersSegments' => $setOthersSegments,
				'ordenationString' => $ordenationString,
				'ordenationAdmin' => $ordenationAdmin,
				'url' => $newUrl
			]);

			return response()->json([
				'success' => true,
				'language' => $getLanguage,
				'firstSegment' => $setFirstSegment,
				'secondSegment' => $setSecondSegment,
				'othersSegments' => $setOthersSegments,
				'newUrl' => $newUrl,
				'ordenationString' => $ordenationString,
				'ordenationAdmin' => $ordenationAdmin,
			]);

        }catch(\Exception $e){
			Log::error("Error in LanguageController: " . $e->getMessage());
			return response()->json(['error' => $e->getMessage()], 500);
        }
    }

	public function load($language, $page) {
		if (!auth()->check()) {
			abort(403);
		}

		$path = resource_path("dictionary/{$language}/{$language}_{$page}.json");
		if (File::exists($path)) {
			return response()->file($path);
		} else {
			abort(404);
		}
	}
}

