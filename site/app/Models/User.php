<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function roles(){
        return $this->belongsToMany(Role::class);
    }

    // public function observationImages(){
    //     return $this->hasMany(ObservationImage::class);
    // }

    public function hasRole($roleNames):bool{

        if(!is_array($roleNames))
            $roleNames = [$roleNames];

        foreach($this->roles as $role){
            if(in_array($role->role, $roleNames))
                return true;
        }

        return false;
    }

	public function remainingRoles()
    {
        $actualRoles = $this->roles;
        $allRoles = Role::all();

        return $allRoles->diff($actualRoles);
    }
}

