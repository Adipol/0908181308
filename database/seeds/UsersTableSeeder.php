<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        User::create([
			'name'=>'Admin',
			'email'=>'adipol13@gmail.com',
			'password'=>bcrypt('siri'),
			'rol_id'=>1
		]);
		User::create([
			'name'=>'Solicitante',
			'email'=>'solicitante@email.com',
			'password'=>bcrypt('secret'),
			'rol_id'=>2
		]);
		User::create([
			'name'=>'Supervisor',
			'email'=>'supervisor@email.com',
			'password'=>bcrypt('secret'),
			'rol_id'=>3
        ]);
        User::create([
			'name'=>'Encargado',
			'email'=>'encargado@email.com',
			'password'=>bcrypt('secret'),
			'rol_id'=>4
		]);
    }
}
