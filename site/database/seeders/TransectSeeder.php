<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Transect;
use Illuminate\Support\Facades\DB;

class TransectSeeder extends Seeder
{
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('data/transectes.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                Transect::create([
                    'name' => $record['name'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
