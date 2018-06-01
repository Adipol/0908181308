<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable=[
		'name',
		'description',
		'condition'
	];

	public function products()
	{
		return $this->hasMany('App\Product','category_id');
	}

	public function setNameAttribute($value){
		
        $this->attributes['name'] = ucfirst((strtolower($value)));
	}
}
