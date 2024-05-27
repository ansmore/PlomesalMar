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
        $speciesMap = [];
        $speciesCsv = Reader::createFromPath(database_path('data/map_species.csv'), 'r');
        $speciesCsv->setHeaderOffset(0);
        foreach ($speciesCsv->getRecords() as $record) {
            $speciesMap[$record['scientific_name']] = $record['id'];
        }

        $csv = Reader::createFromPath(database_path('data/Observacions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                if (isset($record['ID Observació'])) {
                    $speciesId = isset($speciesMap[$record['Espècie']]) ? $speciesMap[$record['Espècie']] : $this->getRandomSpeciesId();

                    $inFlight = $this->convertToBooleanOrSi($record['Vol']);
                    $distanceUnder300m = $this->convertToBooleanOrSi($record['Dist']);

                    $waypoint = empty($record['Waypoint']) || $record['Waypoint'] === 'NA' ? $this->getRandomWaypoint() : $record['Waypoint'];

                    $numberOfIndividuals = $this->convertToNumberOrSi($record['Número']);

                    $time = $record['Hora'];
                    if ($time == '-' || !$this->isValidTime($time)) {
                        $time = $this->getRandomTime();
                    }

                    Observation::create([
                        'id' => $record['ID Observació'],
                        'species_id' => $speciesId,
                        'time' => $time,
                        'waypoint' => $waypoint,
                        'number_of_individuals' => $numberOfIndividuals,
                        'in_flight' => $inFlight,
                        'distance_under_300m' => $distanceUnder300m,
                        'notes' => $record['Comentaris'],
                        'is_validated' => true,
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

    private function convertToBooleanOrSi($value)
    {
        $value = strtolower(trim($value));
        return ($value === 'sí' || $value === 'si' || $value === 'yes' || $value === '1') ? 1 : 0;
    }

    private function convertToNumberOrSi($value)
    {
        if (is_numeric($value)) {
            return (int)$value;
        }

        $value = strtolower(trim($value));
        return ($value === 'sí' || $value === 'si' || $value === 'yes' || $value === '1') ? 1 : 0;
    }

    private function getRandomInFlight()
    {
        return Observation::inRandomOrder()->value('in_flight') ?? false;
    }

    private function getRandomDistance()
    {
        return Observation::inRandomOrder()->value('distance_under_300m') ?? false;
    }

    private function getRandomWaypoint()
    {
        return Observation::inRandomOrder()->value('waypoint') ?? 'WP_DEFAULT';
    }

    private function getRandomNumberOfIndividuals()
    {
        return Observation::inRandomOrder()->value('number_of_individuals') ?? 1;
    }

    private function getRandomSpeciesId()
    {
        return Specie::inRandomOrder()->value('id');
    }

    private function isValidTime($time)
    {
        return preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $time);
    }

    private function getRandomTime()
    {
        $hours = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT);
        $minutes = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
        $seconds = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
        return "$hours:$minutes:$seconds";
    }
}
