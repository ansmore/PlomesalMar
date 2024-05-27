<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use League\Csv\Reader;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csv = Reader::createFromPath(base_path('database/data/Rols.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            $user = User::where('email', strtolower(str_replace(' ', '', $record['Nom'])) . '@plomesalmar.com')->first();
            if ($user) {
                $roles = explode(', ', $record['Rol']);
                foreach ($roles as $role) {
                    $roleName = strtolower($role);
                    $roleModel = Role::where('role', $roleName)->first();
                    if ($roleModel) {
                        RoleUser::create([
                            'user_id' => $user->id,
                            'role_id' => $roleModel->id,
                        ]);
                    }
                }
            }
        }
    }
}
