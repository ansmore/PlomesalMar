<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Departure;
use App\Models\Boat;
use Illuminate\Support\Facades\DB;

class DepartureSeeder extends Seeder
{
    public function run(): void
    {
        // Cargar el mapa de transectos desde el archivo CSV
        $transectMap = [];
        $transectCsv = Reader::createFromPath(database_path('data/map_transects.csv'), 'r');
        $transectCsv->setHeaderOffset(0);
        foreach ($transectCsv->getRecords() as $record) {
            $transectMap[$record['name']] = $record['id'];
        }

        // Cargar los datos de observaciones desde el archivo CSV
        $csv = Reader::createFromPath(database_path('data/Observacions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                if (isset($record['ID Sortida'])) {
                    $departureId = str_replace('_', '', $record['ID Sortida']);
                    $transectId = isset($transectMap[$record['Transsecte']]) ? $transectMap[$record['Transsecte']] : null;

                    $date = $record['Any'] . '-' . str_pad($record['Mes'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($record['Dia'], 2, '0', STR_PAD_LEFT);

                    if ($transectId !== null && !$this->departureExists($departureId, $date)) {
                        Departure::create([
                            'id' => $departureId,
                            'date' => $date,
                            'boat_id' => Boat::inRandomOrder()->first()->id,
                            'transect_id' => $transectId,
                            'observers' => $record['Observadors'] ?? null, // Añadir observadores si están presentes
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function departureExists($departureId, $date)
    {
        return Departure::where('id', $departureId)->where('date', $date)->exists();
    }
}
