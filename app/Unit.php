<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable=[
		'name',
		'abbreviation',
		'condition'
	];
	
	public function products()
    {
        return $this->hasMany('App\Product');
    }
}
