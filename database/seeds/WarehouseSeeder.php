<?php

use Illuminate\Database\Seeder;
use App\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'name'=>'Almacén',
            'ubication'=>'',
            'ucm'=>1
        ]);
    }
}
