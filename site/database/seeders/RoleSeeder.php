<?php

namespace Database\Seeders;

use App\Models\Role;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csv = Reader::createFromPath(base_path('database/data/Rols.csv'), 'r');
        $csv->setHeaderOffset(0);

        $roles = [];

        foreach ($csv as $record) {
            $recordRoles = explode(', ', $record['Rol']);
            foreach ($recordRoles as $role) {
                $roleName = strtolower($role);
                if (!in_array($roleName, $roles)) {
                    $roles[] = $roleName;
                    Role::create([
                        'role' => $roleName,
                    ]);
                }
            }
        }
    }
}
