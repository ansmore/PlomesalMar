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
    }

	public function index(Request $request, $language = null){
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

		// if($this->authorize('preventSelfBlock', $user) && $role->name === 'bloquejat')
        // {
        //     abort(403, "No pots afegir el rol de 'bloquejat' si ets 'admin' ");
        // }

        try{
            $user->roles()->attach($role->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return back()
                ->with('success', "Rol $role->role afegit a $user->name correctament.");
        }catch(QueryException $e){
            return back()
                ->withErrors("No es pot afegir el rol $role->role a $user->name. Es possible que ja tingui aquest rol.");
        }
    }

    public function removeRole(Request $request){
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));

		// if ($this->authorize('lastUserAdmin', [$user, $role])){
        //     return response("No puedes quitarte el rol de 'admin' eres el único 'admin' ", 418);
        //     abort(403, "No puedes treure el rol de 'admin' ets l'únic 'admin' ");
        // }

        try{
            $user->roles()->detach($role->id);
            return back()
                ->with('success', "Rol $role->role retirat a $user->name correctament.");
        }catch(QueryException $e){
            return back()
                ->withErrors("No s'ha pogut retirar el rol $role->role a $user->name. Es possible que ja tingui aquest rol.");
        }
    }

    public function testAbort()
    {
    abort(418, "Això es una prova de l'error 418");
    }

	public function blocked()
    {
        return view('home.blocked');
    }
}
