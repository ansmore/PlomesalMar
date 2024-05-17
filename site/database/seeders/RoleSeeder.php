<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$roles = ['blocked', 'observer', 'validator', 'admin'];

		foreach($roles as $index => $role) {
            Role::create([
                'id' => $index + 1,
                'role' => $role,
            ]);
        }
    }
}
