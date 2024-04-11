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
		$this->call(TransecteSeeder::class);
    }
}
