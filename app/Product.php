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
		'condition'
	];

	public function category()
    {
        return $this->belongsTo('App\Category');
	}

	public function productWarehouses()
	{
		return $this->hasMany('App\ProductWarehouse','product_id');
	}
	
	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}
}
