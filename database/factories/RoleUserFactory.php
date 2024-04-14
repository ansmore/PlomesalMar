<?php

namespace Database\Factories;

use App\Models\Role;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Factories\Factory;

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

		if ($selectedUser->id <= 5){
			$selectedUser = $existingUsers->random();
		}

        return [
            'role_id' => $selectedRole->id,
            'user_id' => $selectedUser->id,
        ];
    }
}
