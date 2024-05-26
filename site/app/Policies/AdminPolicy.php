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


        $adminRole = Role::where('name', 'admin')->first();

        $adminCount = $adminRole->users()->count();

		Log::info("Role being checked: {$role->role}");
        Log::info("Admin count: {$adminCount}");
        Log::info("User being checked: {$user->id}");

		$value = ($adminRole->name === 'admin'
			&& $adminCount === 1
			&& $adminRole->users->contains($user));

		Log::info("Role value: {$value}");

		return !($adminRole->name === 'admin' && $adminCount === 1 && $adminRole->users->contains($user));
    }

    public function preventSelfBlock(User $user, Role $role)
    {

		Log::info("User attempting to add blocked role: {$user->id}");
        Log::info("Role being checked: {$role->role}");

        if ($user->hasRole('admin') && $role->name === 'blocked') {
			return false;
			// return redirect()->back()->withErrors("error", "No pots bloquejar-te a tu mateix.");
        }

        return true;
    }
}
