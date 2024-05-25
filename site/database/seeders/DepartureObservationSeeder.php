<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Departure;
use App\Models\Observation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepartureObservationSeeder extends Seeder
{
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('data/Observacions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                if (isset($record['ID Sortida']) && isset($record['ID Observació'])) {
                    // Eliminar guiones bajos de ID Sortida
                    $departureId = str_replace('_', '', $record['ID Sortida']);
                    $observationId = $record['ID Observació'];

                    $departureExists = Departure::where('id', $departureId)->exists();
                    $observationExists = Observation::where('id', $observationId)->exists();

                    if ($departureExists && $observationExists) {
                        if (!$this->observationExists($departureId, $observationId)) {
                            DB::table('departure_observations')->insert([
                                'departure_id' => $departureId,
                                'observation_id' => $observationId,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function observationExists($departureId, $observationId)
    {
        return DB::table('departure_observations')
            ->where('departure_id', $departureId)
            ->where('observation_id', $observationId)
            ->exists();
    }
}
