<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Display the user management page.
     *
     * @param string|null $language
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index($language = null, Request $request)
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.managementUsers', [
            "users" => $users,
            "roles" => $roles,
            "language" => $language,
        ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @param string|null $language
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $language = null)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "surname" => "nullable|string|max:255",
            "surnameSecond" => "nullable|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8",
        ]);

        try {
            $user = User::createFromRequest($request);
            return redirect()->back()->with("status", "L'usuari ha estat creat correctament a la base de dades.");
        } catch (\Exception $e) {
            Log::error("Error en intentar crear un nou usuari a la base de dades: " . $e->getMessage());
            return redirect()->back()->with("error", "No s'ha pogut registrar l'usuari a la base de dades. Si us plau, revisi els detalls i intenti-ho de nou.");
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param string $language
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $language, $id)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "surname" => "nullable|string|max:255",
            "surnameSecond" => "nullable|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email," . $id,
        ]);

        try {
            $success = User::updateFromRequest($request, $id);
            if ($success) {
                Log::info("Usuari actualitzat correctament.");
                return redirect()->route("admin.user.show", ["user" => $id, "language" => $language])->with("status", "L'usuari ha estat actualitzat correctament a la base de dades.");
            } else {
                Log::info("Error en actualitzar l'usuari.");
                return redirect()->back()->with("error", "La actualització de l'usuari ha fallat. No s'han trobat canvis o l'usuari no existeix.");
            }
        } catch (\Exception $e) {
            Log::error("Error en intentar actualitzar un usuari a la base de dades: " . $e->getMessage());
            return redirect()->back()->with("error", "No s'ha pogut actualitzar l'usuari a la base de dades. Si us plau, revisi els detalls i intenti-ho de nou.");
        }
    }

    /**
     * Display the list of users.
     *
     * @param string|null $language
     * @return \Illuminate\View\View
     */
    public function userList($language = null)
    {
        $users = User::orderBy("name", "ASC")
            ->paginate(config("pagination.users", 8));

        $total_users = User::count();
        $roles = Role::all();

        return view("admin.users.list", [
            "language" => $language,
            "roles" => $roles,
            "users" => $users,
            "total_users" => $total_users,
        ]);
    }

    /**
     * Display the specified user.
     *
     * @param string|null $language
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function userShow($language = null, User $user)
    {
        return view("admin.users.show", [
            "language" => $language,
            "user" => $user
        ]);
    }

    /**
     * Search for users based on input criteria.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function userSearch(Request $request)
    {
        $request->validate([
            "name" => "max:32",
            "email" => "max:32"
        ]);

        $name = $request->input("name", "");
        $email = $request->input("email", "");

        $users = User::orderBy("name", "ASC")
            ->where("name", "like", "%$name%")
            ->where("email", "like", "%$email%")
            ->paginate(config("pagination.users", 8))
            ->appends([
                "name" => $name,
                "email" => $email
            ]);

        $total_users = User::count();

        return view("admin.users.list", [
            "users" => $users,
            "name" => $name,
            "email" => $email,
            "total_users" => $total_users,
        ]);
    }

    /**
     * Assign a role to a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setRole(Request $request)
    {
        $role = Role::find($request->input("role_id"));
        $user = User::find($request->input("user_id"));

        Log::info("Intentant assignar el rol: {$role->role} a l'usuari: {$user->name}");

        try {
            if ($role->role === "blocked") {
                if (!policy(User::class)->preventSelfBlock($user, $role)) {
                    return redirect()->back()->with("error", "No pots bloquejar-te a tu mateix.");
                }
            }

            $user->roles()->attach($role->id, [
                "created_at" => now(),
                "updated_at" => now()
            ]);

            return redirect()->back()->with("status", "Rol '$role->role' assignat a $user->name correctament.");
        } catch (QueryException $e) {
            Log::error("Error assignant el rol: " . $e->getMessage());
            return back()->withErrors("No es pot assignar el rol $role->role a $user->name. És possible que ja tingui aquest rol.");
        }
    }

    /**
     * Remove a role from a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeRole(Request $request)
    {
        $role = Role::find($request->input("role_id"));
        $user = User::find($request->input("user_id"));

        Log::info("Intentant eliminar el rol: {$role->role} de l'usuari: {$user->name}");

        try {
            if ($role->role === "admin") {
                if (!policy(User::class)->lastUserAdmin($user, $role)) {
                    return redirect()->back()->with("error", "No pots retirar el rol $role->role, ets l'únic $role->role.");
                }
                if (!policy(User::class)->ensureAtLeastOneAdmin($user, $role)) {
                    return redirect()->back()->with("error", "No pots retirar el rol d'administrador perquè ha d'haver-hi almenys un administrador.");
                }
                if (!policy(User::class)->preventSelfAdminRemoval($user)) {
                    return redirect()->back()->with("error", "No pots retirar el teu propi rol d'administrador.");
                }
            }

            $user->roles()->detach($role->id);

            return redirect()->back()->with("status", "Rol '$role->role' eliminat de $user->name correctament.");
        } catch (\Exception $e) {
            Log::error("Error inesperat: " . $e->getMessage());
            return redirect()->back()->withErrors("S'ha produït un error inesperat. Si us plau, intenta-ho més tard.");
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @param string|null $language
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $language = null)
    {
        try {
            $success = User::deleteById($id);
            if ($success) {
                return redirect()->route("admin.users", ["language" => $language])->with("status", "Usuari eliminat correctament.");
            } else {
                return redirect()->back()->with("error", "No s'ha pogut eliminar l'usuari de la base de dades.");
            }
        } catch (\Exception $e) {
            Log::error("Error eliminant l'usuari de la base de dades: " . $e->getMessage());
            return redirect()->back()->with("error", "Ha ocorregut un error en intentar eliminar l'usuari.");
        }
    }

    /**
     * Display the blocked page.
     *
     * @param string|null $language
     * @return \Illuminate\View\View
     */
    public function blocked($language = null)
    {
        return view("pages.blocked", ["language" => $language]);
    }
}
