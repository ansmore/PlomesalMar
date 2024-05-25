<?php

namespace App\Models;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * Crea una nueva especie a partir de los datos proporcionados en la solicitud.
     *
     * @param Request $request
     * @return Specie
     */
    public static function createFromRequest(Request $request): Specie
    {
        $newUser = self::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        Log::info('Specie created from request:', [
            'name' => $newUser->name,
            'email' => $newUser->email
        ]);

        return $newUser;
    }

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

