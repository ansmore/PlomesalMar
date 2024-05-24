<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageObservation;
use App\Models\Observation;
use App\Models\User;
use League\Csv\Reader;
use Illuminate\Support\Facades\Log;

class ImageObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo CSV para obtener el mapa de species_id a nombres de archivos de imágenes
        $speciesMap = $this->getSpeciesImageMap();
        $speciesImageIdMap = [];

        // Subir todas las imágenes únicas por especie y obtener sus image_id
        foreach ($speciesMap as $speciesId => $imageFile) {
            $imageId = $this->uploadImageAndGetId($imageFile);
            if ($imageId) {
                $speciesImageIdMap[$speciesId] = $imageId;
            }
        }

        // Obtener todas las observaciones en la base de datos
        $observations = Observation::all();

        // Iterar sobre todas las observaciones y crear ImageObservation para cada una
        foreach ($observations as $observation) {
            // Encontrar un usuario aleatorio
            $user = User::inRandomOrder()->first();

            // Crear ImageObservation con el número de fotografía aleatorio
            $this->createImageObservation($observation, $user, $this->generateUniquePhotographyNumber(), $speciesImageIdMap);
        }
    }

    /**
     * Create an ImageObservation with the correct image_id based on the species_id.
     */
    private function createImageObservation($observation, $user, $photographyNumber, $speciesImageIdMap)
    {
        $speciesId = $observation->species_id;
        $imageId = $speciesImageIdMap[$speciesId] ?? null;

        if ($imageId) {
            ImageObservation::create([
                'observation_id' => $observation->id,
                'user_id' => $user->id,
                'photography_number' => $photographyNumber,
                'image_id' => $imageId,
            ]);
        }
    }

    /**
     * Upload the image and get the image ID from the API.
     */
    private function uploadImageAndGetId($imageFile)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST', config('services.api.url') . '/api/V1/images', [
                'headers' => [
                    'Accept' => 'application/json',
                    'APP-TOKEN' => config('services.api.token'),
                ],
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen(public_path('img/species/' . $imageFile), 'r'),
                    ],
                ],
            ]);

            if ($response->getStatusCode() == 201) {
                $data = json_decode($response->getBody()->getContents(), true);
                return $data['imageId'];
            } else {
                \Log::error('Error uploading image: ' . $imageFile);
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Exception uploading image: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get the species to image map from the CSV file.
     */
    private function getSpeciesImageMap()
    {
        $speciesMap = [];
        $csv = Reader::createFromPath(database_path('data/map_species.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv->getRecords() as $record) {
            $speciesMap[$record['id']] = $record['image'];
        }

        return $speciesMap;
    }

    /**
     * Generate a unique photography number.
     */
    private function generateUniquePhotographyNumber()
    {
        return ImageObservation::max('photography_number') + 1;
    }
}
