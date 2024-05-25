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
			'email'=> 'avalls89@gmail.com',
			'name'=>'Albert',
			'surname' => 'Valls',
			'surnameSecond' => 'Berengueras',
			'password'=> Hash::make('qwerty12'),
		]);
			User::factory()->create([
			'email'=> 'alfred@mail.com',
			'name'=>'Alfred',
			'surname' => 'Perez',
			'surnameSecond' => 'Herranz',
			'password'=> Hash::make('qwerty12'),
		]);
        User::factory()->create([
            'email'=> 'admin@mail.com',
            'name'=>'Admin',
			'surname' => 'admin',
			'surnameSecond' => 'admin',
            'password'=> Hash::make('qwerty12'),
        ]);
		User::factory()->create([
            'email'=> 'blocked@mail.com',
            'name'=>'Bloquejat',
			'surname' => 'bloquejat',
			'surnameSecond' => 'bloquejat',
            'password'=> Hash::make('qwerty12'),
        ]);
        User::factory()
            ->count(10)
            ->create();
    }
}
