<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
			'name'         => 'Administrador',
			'abbreviation' => 'admin',
		]);
		Rol::create([
			'name'         => 'Solicitante',
			'abbreviation' => 'sol'
		]);
		Rol::create([
			'name'         => 'Supervisor',
			'abbreviation' => 'super'
        ]);

        Rol::create([
			'name'         => 'Encargado del almacen',
			'abbreviation' => 'enc'
		]);
    }
}
