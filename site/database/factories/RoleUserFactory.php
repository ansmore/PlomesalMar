<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserFactory extends Factory
{
    protected $model = RoleUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $existingRoles = Role::all();
        $existingUsers = User::all();

        if ($existingRoles->isEmpty()) {
            $existingRoles = Role::factory()->count(1)->create();
        }

        if ($existingUsers->isEmpty()) {
            $existingUsers = User::factory()->count(1)->create();
        }

        $selectedUser = $existingUsers->random();
        $selectedRole = $existingRoles->random();

        return [
            'role_id' => $selectedRole->id,
            'user_id' => $selectedUser->id,
        ];
    }
}
