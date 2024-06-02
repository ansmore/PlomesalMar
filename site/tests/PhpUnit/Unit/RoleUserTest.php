<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_user_belongs_to_user()
    {
        $user = User::factory()->create();
        $roleUser = RoleUser::factory()->create(['user_id' => $user->id]);

        $roleUser->load('user');

        $this->assertNotNull($roleUser->user, 'Users relation is null');

        $this->assertEquals($user->id, $roleUser->user->id);
    }

    public function test_role_user_belongs_to_role()
    {
        $role = Role::factory()->create();
        $roleUser = RoleUser::factory()->create(['role_id' => $role->id]);

        $roleUser->load('role');

        $this->assertNotNull($roleUser->role, 'Roles relation is null');

        // Comparar el ID del rol
        $this->assertEquals($role->id, $roleUser->role->id);
    }
}
