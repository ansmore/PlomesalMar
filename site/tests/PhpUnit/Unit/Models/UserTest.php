<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_roles()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['role' => 'admin']);
        $user->roles()->attach($role);

        $this->assertTrue($user->roles()->first()->role === 'admin');
    }

    public function test_has_role_checks_correctly()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['role' => 'admin']);
        $user->roles()->attach($role);

        $this->assertTrue($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('subscriber'));
    }

    public function test_role_changes_affect_relationships()
	{
		$user = User::factory()->create();
		$role1 = Role::factory()->create(['role' => 'admin']);
		$role2 = Role::factory()->create(['role' => 'editor']);

		$user->roles()->attach($role1);
		$this->assertTrue($user->hasRole('admin'));

		$user->roles()->sync([$role2->id]);

		$user->refresh();

		$this->assertFalse($user->hasRole('admin'));
		$this->assertTrue($user->hasRole('editor'));
	}
}
