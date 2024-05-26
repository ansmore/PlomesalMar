<?php

namespace App\Providers;


use App\Models\Role;
use App\Policies\AdminPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Role::class => AdminPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
