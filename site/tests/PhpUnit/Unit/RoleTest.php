<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_role()
    {
        $role = Role::create(['role' => 'admin']);
        $this->assertModelExists($role);
        $this->assertEquals('admin', $role->role);
    }

    public function test_role_can_be_assigned_to_user()
    {
        $role = Role::create(['role' => 'editor']);
        $user = User::factory()->create();
        $user->roles()->attach($role);

        $this->assertTrue($user->roles->contains($role));
    }

    public function test_role_can_be_removed_from_user()
    {
        $role = Role::create(['role' => 'subscriber']);
        $user = User::factory()->create();
        $user->roles()->attach($role);

        $this->assertTrue($user->roles->contains($role));

        $user->roles()->detach($role);
        $user->refresh();

        $this->assertFalse($user->roles->contains($role));
    }

    public function test_delete_role()
    {
        $role = Role::create(['role' => 'moderator']);
        $role->delete();

        $this->assertModelMissing($role);
    }
}
