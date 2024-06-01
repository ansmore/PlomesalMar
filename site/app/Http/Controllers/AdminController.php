<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

	public function index($language = null, Request $request){
        $users = User::all();
		$roles = Role::all();
		return view('admin.managementUsers', [
			'users' => $users,
			'roles' => $roles,
			'language' => $language,
		]);
    }

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, $language = null)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'surname' => 'string|max:255|nullable',
			'surnameSecond' => 'string|max:255|nullable',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8',
		]);

		try {
			$user = User::createFromRequest($request);
			return redirect()->back()->with('status', 'El usuario ha sido creado exitosamente en la base de datos.');
		} catch (\Exception $e) {
			Log::error('Error al intentar crear un nuevo usuario en la base de datos: ' . $e->getMessage());
			return redirect()->back()->with('error', 'No se pudo registrar el usuario en la base de datos. Por favor, revise los detalles e intente de nuevo.');
		}
	}

		/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, $language, $id)
	{
		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'surname' => 'nullable|string|max:255',
			'surnameSecond' => 'nullable|string|max:255',
			'email' => 'required|string|email|max:255|unique:users,email,' . $id,
		]);

		try {
			$success = User::updateFromRequest($request, $id);
			if ($success) {
				Log::info('success al actialitzar:');
                return redirect()->route('admin.user.show', ['user' => $id, 'language' => $language])->with('status', 'El user ha sido actualizado exitosamente en la base de datos.');
            } else {

				Log::info('error al actialitzar:');
                return redirect()->back()->with('error', 'La actualización del user falló. No se encontraron cambios o el user no existe.');
            }

		} catch (\Exception $e) {
			Log::error('Error al intentar actualitzar un usuari en la base de datos: ' . $e->getMessage());
			return redirect()->back()->with('error', 'No se pudo actualitzar el usuario en la base de datos. Por favor, revise los detalles e intente de nuevo.');
		}
	}

    public function userList($language = null){
        $users = User::orderBy('name', 'ASC')
            ->paginate(config('pagination.users', 8));

        $total_users = User::count();
		$roles = Role::all();

        return view('admin.users.list', [
			'language' => $language,
			'roles' => $roles,
            'users' =>$users,
            'total_users' => $total_users,
        ]);
    }

    public function userShow($language = null, User $user){
        return view('admin.users.show', [
			'language' => $language,
			'user' => $user]);
    }

    public function userSearch(Request $request){
        $request->validate([
            'name' => 'max:32',
            'email' => 'max:32']);

        $name = $request->input('name', '');
        $email = $request->input('email', '');

        $users = User::orderBy('name', 'ASC')
            ->where('name', 'like', "%$name%")
            ->where('email', 'like', "%$email%")
            ->paginate(config('pagination.users', 8))
            ->appends([
                'name' => $name,
                'email' => $email
            ]);

        $total_users = User::count();

        return view('admin.users.list', [
            'users'=>$users,
            'name' => $name,
            'email' => $email,
            'total_users' => $total_users,
        ]);
    }

	public function setRole(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));

        Log::info("Attempting to set role: {$role->role} for user: {$user->name}");

		try{
			if ($role->role === 'blocked') {
                if (!policy(User::class)->preventSelfBlock($user, $role)) {
                    return redirect()->back()->with("error", "No pots bloquejar-te a tu mateix.");
                }
            }

			Log::info("No pots afegir el rol: $role->role a l'usuari: {$user->name}");

			$user->roles()->attach($role->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);

			return redirect()->back()->with("status", "Rol '$role->role' afegit a $user->name correctament.");
        }catch(QueryException $e){
			Log::error("Error attaching role: " . $e->getMessage());
            return back()->withErrors("No es pot afegir el rol $role->role a $user->name. Es possible que ja tingui aquest rol.");
        }
    }

    public function removeRole(Request $request){
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));

        Log::info("Attempting to remove role: {$role->role} from user: {$user->name}");

		try{
			if ($role->role === 'admin') {
                if (!policy(User::class)->lastUserAdmin($user, $role)) {
                    return redirect()->back()->with("error", "No pots retirar el $role->role, ets l'únic $role->role.");
                }
                if (!policy(User::class)->ensureAtLeastOneAdmin($user, $role)) {
                    return redirect()->back()->with("error", "No puedes quitar el rol de 'admin' porque debe haber al menos un administrador.");
                }
				if (!policy(User::class)->preventSelfAdminRemoval($user)) {
                    return redirect()->back()->with("error", "No pots retirar el teu propi rol d'administrador.");
                }
            }

			$user->roles()->detach($role->id);

			return redirect()->back()->with("status", "Rol '$role->role' retirat a $user->name correctament.");
        } catch (\Exception $e) {
        Log::error("Unexpected error: " . $e->getMessage());
        return redirect()->back()->withErrors("S'ha produït un error inesperat. Si us plau, intenta-ho més tard.");
		}
    }

	/**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $language = null)
    {
        try {
            $success = User::deleteById($id);
            if ($success) {
                return redirect()->route('admin.users', ['language' => $language])->with('status', 'Usuari eliminat correctament.');
            } else {
                return redirect()->back()->with('error', "No s'ha pogut eliminar l'usuari de la base de dades.");
            }
        } catch (\Exception $e) {
            Log::error("Error al eliminar l'usuari de la base de dades: " . $e->getMessage());
            return redirect()->back()->with('error', "Ha ocorregut un error al intentar eliminar l'usuari. ");
        }
    }

    public function testAbort($language = null)
    {
		abort(418, "Això es una prova de l'error 418");
    }

	public function blocked($language = null)
    {
        return view('pages.blocked', ['language' => $language]);
    }
}
