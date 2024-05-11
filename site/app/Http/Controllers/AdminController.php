<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index($language = null){
        return view('admin.management', [
			'language' => $language,
		]);
    }

    public function userList($language = null){
        $users = User::orderBy('name', 'ASC')
            ->paginate(config('pagination.users', 8));

        $total_users = User::count();

        return view('admin.users.list', [
			'language' => $language,
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
