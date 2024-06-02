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
            $setThirdSegment = $request->input('thirdSegment', '');
            $setOthersSegments = $request->input('othersSegments', '');

            if ($setFirstSegment == "" || $setFirstSegment == "/") {
				$setFirstSegment = "home";
            }

            // Initialize QueriString as empty
            $firstItemQueriString = '';
            $secondItemQueriString= '';
			$thirdItemQueriString='';

            // Check if first segment contains '?'
            if (strpos($setFirstSegment, '?') !== false) {
                list($setFirstSegment, $firstItemQueriString) = explode('?', $setFirstSegment, 2);
            }

			// Check if second segment contains '?'
            if (strpos($setSecondSegment, '?') !== false) {
                list($setSecondSegment, $secondItemQueriString) = explode('?', $setSecondSegment, 2);
            }

			// Check if third segment contains '?'
            if (strpos($setThirdSegment, '?') !== false) {
                list($setThirdSegment, $thirdItemQueriString) = explode('?', $setThirdSegment, 2);
            }

			Session::put('language', $setLanguage);
			$getLanguage = session('language');


			if ($setSecondSegment === "") {
				// Construye la nueva URL con el idioma actual
				$newUrl = route($setFirstSegment, ['language' => $getLanguage]);

			} else if($secondItemQueriString !== "") {

				$segments2 = $setFirstSegment.".".$setSecondSegment;

				// Utilitza $newUrl per a construir la ruta final amb el llenguatge
				$newUrl = route($segments2, [
					'language' => $getLanguage
				]);

				Log::channel('language_middleware')->info('concat_admin', [
					'language' => $setLanguage,
					'url' => $newUrl,
					'firstSegment' => $setFirstSegment,
					'secondSegment' => $setSecondSegment,
					'idSegment' => $setIdSegment,
					'thirdSegment' => $setThirdSegment,
					'othersSegments' => $setOthersSegments,
					'firstItemQueriString' => $firstItemQueriString,
					'secondItemQueriString' => $secondItemQueriString,
					'thirdItemQueriString' => $thirdItemQueriString,
				]);

			} else if ($setSecondSegment !== $setOthersSegments) {

				$segments = $setFirstSegment.".".$setSecondSegment.".".$setThirdSegment;

				switch($setSecondSegment){
					case "user":
						$newUrl = route($segments, [
							'language' => $getLanguage,
							'user' => $setIdSegment,
						]);
						break;
					case "observation":
						$newUrl = route($segments, [
							'language' => $getLanguage,
							'observation' => $setIdSegment,
						]);
						break;
					default:
						echo "Problemes en la ruta.";
						break;
				}
				// Utilitza $newUrl per a construir la ruta final amb el llenguatge
				// $newUrl = route($segments, [
				// 	'language' => $getLanguage,
				// 	'id' => $setIdSegment,
				// 	'user' => $setIdSegment,
				// 	'observation' => $setIdSegment
				// ]);

				Log::channel('language_middleware')->info('concat_diferent', [
					'language' => $setLanguage,
					'url' => $newUrl,
					'firstSegment' => $setFirstSegment,
					'secondSegment' => $setSecondSegment,
					'idSegment' => $setIdSegment,
					'thirdSegment' => $setThirdSegment,
					'othersSegments' => $setOthersSegments,
					'firstItemQueriString' => $firstItemQueriString,
					'secondItemQueriString' => $secondItemQueriString,
					'thirdItemQueriString' => $thirdItemQueriString,
				]);

			}else {
				$segments = $setFirstSegment.".".$setSecondSegment;

				Log::channel('language_middleware')->info('concat_else', [
					'url' => $segments
				]);

				$newUrl = route($segments, [
					'language' => $getLanguage,
				]);
			}

			Log::channel('language_middleware')->info('Setting language', [
				'language' => $setLanguage,
				'url' => $newUrl,
				'firstSegment' => $setFirstSegment,
				'secondSegment' => $setSecondSegment,
				'idSegment' => $setIdSegment,
				'thirdSegment' => $setThirdSegment,
				'othersSegments' => $setOthersSegments,
				'firstItemQueriString' => $firstItemQueriString,
				'secondItemQueriString' => $secondItemQueriString,
				'thirdItemQueriString' => $thirdItemQueriString,
			]);

			return response()->json([
				'success' => true,
				'newUrl' => $newUrl,
				'language' => $getLanguage,
				'firstSegment' => $setFirstSegment,
				'secondSegment' => $setSecondSegment,
				'idSegment' => $setIdSegment,
				'thirdSegment' => $setThirdSegment,
				'othersSegments' => $setOthersSegments,
				'firstItemQueriString' => $firstItemQueriString,
				'secondItemQueriString' => $secondItemQueriString,
				'thirdItemQueriString' => $thirdItemQueriString,
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

