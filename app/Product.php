<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
		'category_id',
		'unit_id',
		'name',
		'description',
		'stock',
		'condition'
	];

	public function category()
    {
        return $this->belongsTo('App\Category');
	}
	
	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}
}
