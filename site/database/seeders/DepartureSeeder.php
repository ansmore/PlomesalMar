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
        // Leer mapeo de transectos
        $transectMap = [];
        $transectCsv = Reader::createFromPath(database_path('data/map_transects.csv'), 'r');
        $transectCsv->setHeaderOffset(0);
        foreach ($transectCsv->getRecords() as $record) {
            $transectMap[$record['name']] = $record['id'];
        }

        // Leer archivo de observaciones
        $csv = Reader::createFromPath(database_path('data/Observacions.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                if (isset($record['ID Sortida'])) {
                    // Eliminar guiones bajos de ID Sortida
                    $departureId = str_replace('_', '', $record['ID Sortida']);
                    $transectId = isset($transectMap[$record['Transsecte']]) ? $transectMap[$record['Transsecte']] : null;

                    // Verificar formato de tiempo
                    $time = $record['Hora'];
                    if ($time == '-' || !$this->isValidTime($time)) {
                        $time = $this->getRandomTime();
                    }

                    // Solo crear registro si el transect_id es válido
                    if ($transectId !== null) {
                        Departure::create([
                            'date' => $record['Any'] . '-' . $record['Mes'] . '-' . $record['Dia'],
                            'time' => $time,
                            'boat_id' => Boat::inRandomOrder()->first()->id,
                            'transect_id' => $transectId,
                        ]);
                    } else {
                        // Registrar un mensaje de error para el transecto no encontrado
                        error_log("Transecto no encontrado para el registro con ID Sortida: {$departureId}");
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function isValidTime($time)
    {
        // Verificar si el tiempo tiene el formato HH:MM:SS
        return preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $time);
    }

    private function getRandomTime()
    {
        // Generar un tiempo aleatorio en formato HH:MM:SS
        $hours = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT);
        $minutes = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
        $seconds = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
        return "$hours:$minutes:$seconds";
    }
}
