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
        // Crear roles de usuarios específicos
        $this->createRoleUser(1, 4); // Admin
        $this->createRoleUser(2, 4); // Albert
        $this->createRoleUser(3, 4); // Alferd
        $this->createRoleUser(4, 1); // Bloquejat

        // Crear 5 roles aleatorios de usuario
        RoleUser::factory()->count(5)->create();
    }

    /**
     * Crear un rol de usuario solo si no existe.
     */
    private function createRoleUser($userId, $roleId)
    {
        $exists = RoleUser::where('role_id', $roleId)->where('user_id', $userId)->exists();

        if (!$exists) {
            RoleUser::factory()->create([
                'role_id' => $roleId,
                'user_id' => $userId,
            ]);
        }
    }
}
