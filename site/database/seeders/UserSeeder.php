<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use League\Csv\Reader;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csv = Reader::createFromPath(base_path('database/data/Rols.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $names = explode(' ', $record['Nom']);
            $name = $names[0];
            $surname = count($names) > 1 ? $names[1] : null;
            $surnameSecond = count($names) > 2 ? $names[2] : null;

            User::create([
                'name' => $name,
                'surname' => $surname,
                'surnameSecond' => $surnameSecond,
                'email' => strtolower(str_replace(' ', '', $record['Nom'])) . '@plomesalmar.com',
                'password' => Hash::make('qwerty12'),
            ]);
        }
    }
}
