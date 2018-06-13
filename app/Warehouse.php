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
    
    public function incomes()
    {
        return $this->hasmany('App\Income');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','user_warehouses','warehouse_id','user_id');    
    }

    public function setNameAttribute($value){
		
        $this->attributes['name'] = ucfirst((strtolower($value)));
    }

    public function setUbicationAttribute($value){
		
        $this->attributes['ubication'] = strtolower($value);
    } 
}
