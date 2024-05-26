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
			'surname' => 'required|string|max:255',
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

        Log::info("Attempting to set role: {$role->role} for user: {$user->id}");

		try{
			if ($role->role === 'blocked') {
				Log::info("No pots afegir el rol: {$role->role} a l'usuari: {$user->name}");
				$this->authorize('preventSelfBlock', [$user, $role]);
			}

			$user->roles()->attach($role->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);

			if($user->roles->contains($role->id)){
				return redirect()->back()->with("status", "Rol '$role->role' afegit a $user->name correctament.");
			} else {
				return redirect()->back()->with("status", "S'ha produït un error al afegir el rol '$role->role' a $user->name.");
			}
        }catch(QueryException $e){
            return back()
                ->withErrors("No es pot afegir el rol $role->role a $user->name. Es possible que ja tingui aquest rol.");
        }
    }

    public function removeRole(Request $request){
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));

        Log::info("Attempting to remove role: {$role->role} from user: {$user->id}");

		try{
			if ($role->role === 'admin') {
				$this->authorize('lastUserAdmin', [$user, $role]);
			}

			$user->roles()->detach($role->id);

			if(!$user->roles->contains($role->id)){
				return  redirect()->back()->with("status", "Rol '$role->role' retirat a $user->name correctament.");
			} else {
				return redirect()->back()->with('status', "S'ha produït un error al retirar '$role->role' a $user->name.");
			}
        } catch (\Exception $e) {
        Log::error("Unexpected error: " . $e->getMessage());
        return redirect()->back()->with('error', "S'ha produït un error inesperat. Si us plau, intenta-ho més tard.");
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
