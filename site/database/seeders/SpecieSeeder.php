<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Models\Specie;

class SpecieSeeder extends Seeder
{
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('data/Llistat-ocells.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        
        foreach ($records as $record) {
            Specie::create([
                'common_name' => $record['Nom comú'],
                'scientific_name' => $record['Espècie'],
            ]);
        }
    }
}
