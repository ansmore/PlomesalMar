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
        'surname',
        'surnameSecond',
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
	 * Crea un nuevo usuario a partir de los datos proporcionados en la solicitud.
	 *
	 * @param Request $request
	 * @return User
	 */
	public static function createFromRequest(Request $request): User
	{
		$hashedPassword = bcrypt($request->input('password'));

		Log::info('Creating user with hashed password', [
			'password' => $hashedPassword
		]);

		$newUser = self::create([
			'name' => $request->input('name'),
			'surname' => $request->input('surname'),
			'surnameSecond' => $request->input('surnameSecond'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password')),
		]);

		Log::info('User created from request:', [
			'name' => $newUser->name,
			'surname' => $newUser->surname,
			'surnameSecond' => $newUser->surnameSecond,
			'email' => $newUser->email,
			'password' => $newUser->password
		]);

		return $newUser;
	}

	public static function updateFromRequest(Request $request, $id): bool
	{
		$user = self::find($id);

		Log::info('User updated from request:', [
			'name' => $request->name,
			'surname' => $request->surname,
			'surnameSecond' => $request->surnameSecond,
			'email' => $request->email,
		]);

		if ($user) {
			$user->update([
				'name' => $request->name,
				'surname' => $request->surname ?? '',
				'surnameSecond' => $request->surnameSecond ?? '',
				'email' => $request->email,
			]);
			return true;
		}
		return false;
	}

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Elimina una especie basada en el ID proporcionado.
     *
     * @param int $id El ID del usario a eliminar.
     * @return bool
     */
    public static function deleteById($id): bool
    {
        $users = self::find($id);
        if ($users) {
            $users->delete();
            return true;
        }
        return false;
    }

	public function roles(){
        return $this->belongsToMany(Role::class);
    }


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

	// public function observationImages(){
	//     return $this->hasMany(ObservationImage::class);
	// }
}

