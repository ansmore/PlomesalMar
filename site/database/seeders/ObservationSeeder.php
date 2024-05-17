<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Observation;
use App\Models\Specie;
use Illuminate\Support\Facades\DB;

class ObservationSeeder extends Seeder
{
    public function run(): void
    {
        // Leer mapeo de especies
        $speciesMap = [];
        $speciesCsv = Reader::createFromPath(database_path('data/map_species.csv'), 'r');
        $speciesCsv->setHeaderOffset(0);
        foreach ($speciesCsv->getRecords() as $record) {
            $speciesMap[$record['scientific_name']] = $record['id'];
        }

        // Leer archivo de observaciones
        $csv = Reader::createFromPath(database_path('data/Observacions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                if (isset($record['ID Observació'])) {
                    $speciesId = isset($speciesMap[$record['Espècie']]) ? $speciesMap[$record['Espècie']] : $this->getRandomSpeciesId();

                    // Verificar y reemplazar valores 'NA' o nulos para 'in_flight' y 'distance_under_300m'
                    $inFlight = ($record['Vol'] === 'NA' || is_null($record['Vol'])) ? $this->getRandomInFlight() : $this->convertToBoolean($record['Vol']);
                    $distanceUnder300m = ($record['Dist'] === 'NA' || is_null($record['Dist'])) ? $this->getRandomDistance() : $this->convertToBoolean($record['Dist']);

                    // Verificar y reemplazar valores de 'waypoint'
                    $waypoint = empty($record['Waypoint']) || $record['Waypoint'] === 'NA' ? $this->getRandomWaypoint() : $record['Waypoint'];

                    // Verificar y reemplazar valores de 'number_of_individuals'
                    $numberOfIndividuals = is_numeric($record['Número']) ? (int)$record['Número'] : $this->getRandomNumberOfIndividuals();

                    // Verificar y reemplazar species_id nulo
                    if ($speciesId === null) {
                        $speciesId = $this->getRandomSpeciesId();
                    }

                    // Verificar y reemplazar distance_under_300m nulo
                    if ($distanceUnder300m === null) {
                        $distanceUnder300m = $this->getRandomDistance();
                    }

                    // Verificar y reemplazar in_flight nulo
                    if ($inFlight === null) {
                        $inFlight = $this->getRandomInFlight();
                    }

                    Observation::create([
                        'id' => $record['ID Observació'],
                        'species_id' => $speciesId,
                        'waypoint' => $waypoint,
                        'number_of_individuals' => $numberOfIndividuals,
                        'in_flight' => $inFlight,
                        'distance_under_300m' => $distanceUnder300m,
                        'notes' => $record['Comentaris'],
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function convertToBoolean($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    private function getRandomInFlight()
    {
        // Obtener un valor aleatorio de in_flight ya existente en la base de datos
        return Observation::inRandomOrder()->value('in_flight') ?? false;
    }

    private function getRandomDistance()
    {
        // Obtener un valor aleatorio de distance_under_300m ya existente en la base de datos
        return Observation::inRandomOrder()->value('distance_under_300m') ?? false;
    }

    private function getRandomWaypoint()
    {
        // Obtener un valor aleatorio de waypoint ya existente en la base de datos
        return Observation::inRandomOrder()->value('waypoint') ?? 'WP_DEFAULT';
    }

    private function getRandomNumberOfIndividuals()
    {
        // Obtener un valor aleatorio de number_of_individuals ya existente en la base de datos
        return Observation::inRandomOrder()->value('number_of_individuals') ?? 1;
    }

    private function getRandomSpeciesId()
    {
        // Obtener un valor aleatorio de species_id ya existente en la base de datos
        return Specie::inRandomOrder()->value('id');
    }
}
