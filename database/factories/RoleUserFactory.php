<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Role;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		 $existingRoles = Role::all();
        $existingUsers = User::all();

        if ( $existingRoles->isEmpty()) {
            $existingRoles = Role::factory()->create();
        }

        if ($existingUsers->isEmpty() ) {
            $existingUsers = User::factory()->create();
        }

        $selectedUser = $existingUsers->random();
        $selectedRole = $existingRoles->random();

        return [
            'role_id' => $selectedRole->id,
            'user_id' => $selectedUser->id,
        ];
    }
}
