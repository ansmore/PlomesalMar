<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table('users')->delete();
		User::factory()->create([
			'email'=> 'albert@mail.com',
			'name'=>'albert',
			'password'=> Hash::make('qwerty12'),
		]);
			User::factory()->create([
			'email'=> 'alfred@mail.com',
			'name'=>'alfred',
			'password'=> Hash::make('qwerty12'),
		]);
        User::factory()->create([
            'email'=> 'admin@mail.com',
            'name'=>'admin',
            'password'=> Hash::make('qwerty12'),
        ]);
		User::factory()->create([
            'email'=> 'blocked@mail.com',
            'name'=>'bloquejat',
            'password'=> Hash::make('qwerty12'),
        ]);
        User::factory()
            ->count(10)
            ->create();
    }
}
