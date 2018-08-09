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
	
	public function setNameAttribute($value)
	{	
        $this->attributes['name'] = strtolower($value);
	}

	public function setAbbreviationAttribute($value)
	{	
        $this->attributes['abbreviation'] = strtolower($value);
	}
}
