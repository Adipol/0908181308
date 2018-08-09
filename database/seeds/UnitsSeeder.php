<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name'=>'unidades',
            'abbreviation'=>'uds.',
            'ucm'=>1
        ]);
    }
}
