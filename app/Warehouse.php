<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable=[
        'name',
        'ubication'
    ];

    public function productWarehouse()
    {
        return $this->hasMany('App\ProductWarehouse');
    }
}
