<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

	public function lastUserAdmin(User $user, Role $role)
    {
        $adminRole = Role::where('role', 'admin')->first();
        $adminCount = $adminRole->users()->count();

		Log::info("Role being checked: {$role->role}");
        Log::info("Admin count: {$adminCount}");
        Log::info("User being checked: {$user->name}");

		return !($adminRole->role === 'admin' && $adminCount === 1 && $adminRole->users->contains($user));

    }

    public function preventSelfBlock(User $user, Role $role)
    {
		Log::info("User attempting to add blocked role: {$user->id}");
        Log::info("Role being checked: {$role->role}");

        if ($user->id === auth()->id() && $role->role === 'blocked') {
			return false;
        }

        return true;
    }

	public function ensureAtLeastOneAdmin(User $user, Role $role)
    {
        $adminRole = Role::where('role', 'admin')->first();
        $adminCount = $adminRole->users()->count();

        Log::info("Checking to ensure at least one admin remains.");
        Log::info("Current admin count: {$adminCount}");

        return $adminCount > 1;
    }

	public function preventSelfAdminRemoval(User $user)
    {
        return !$user->hasRole('admin') || $user->id !== auth()->id();
    }
}
