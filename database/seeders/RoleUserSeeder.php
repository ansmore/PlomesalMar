<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Crear usuari administrador Admin
         */
        $user = User::find(1);
        $role = Role::find(5);
        RoleUser::factory()->create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
		 /**
         * Crear usuari administrador Albert
         */
        $user = User::find(2);
        $role = Role::find(5);
        RoleUser::factory()->create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
		 /**
         * Crear usuari administrador Alferd
         */
        $user = User::find(3);
        $role = Role::find(5);
        RoleUser::factory()->create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        /**
         * Crear usuari bloquejat Bloquejat
         */
        $user = User::find(4);
        $role = Role::find(1);
        RoleUser::factory()->create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        /**
         * Creació de 5 rols aleatoris d'ususari
         */
        // RoleUser::factory()->count(5)->create();
    }
}
