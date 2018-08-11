<?php

use Illuminate\Database\Seeder;
use App\Warehouse;

class WarehousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'name'      => 'almacen',
            'ubication' => '',
            'ucm'       => 1
        ]);
    }
}
