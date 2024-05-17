<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Departure;
use App\Models\Observation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepartureUserObservationSeeder extends Seeder
{
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('data/Observacions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        // Obtener todos los IDs de usuarios existentes
        $userIds = User::pluck('id')->toArray();

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
                        $userId = $this->getRandomUserId($userIds);

                        if (!$this->observationExists($observationId)) {
                            DB::table('departure_user_observations')->insert([
                                'departure_id' => $departureId,
                                'user_id' => $userId,
                                'observation_id' => $observationId,
                                'is_observer' => $this->getRandomIsObserver(),
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

    private function getRandomUserId($userIds)
    {
        return $userIds[array_rand($userIds)];
    }

    private function getRandomIsObserver()
    {
        return (bool)random_int(0, 1);
    }

    private function observationExists($observationId)
    {
        return DB::table('departure_user_observations')
            ->where('observation_id', $observationId)
            ->exists();
    }
}
