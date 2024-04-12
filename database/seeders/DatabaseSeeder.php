<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
		$this->call(RoleUserSeeder::class);
		$this->call(BoatSeeder::class);
		$this->call(TransectSeeder::class);
		$this->call(SpecieSeeder::class);
    $this->call(DepartureSeeder::class);
    $this->call(ObservationSeeder::class);
    $this->call(DepartureUserObservationSeeder::class);
    }
}
