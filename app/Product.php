<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected static function boot () {
		parent::boot();
		static::creating(function (Product $product) {
			if( ! \App::runningInConsole()) {
				$product->slug = str_slug($product->name,"-");
			}
		});
	}
	
	protected $fillable=[
		'category_id',
		'unit_id',
		'name',
		'description',
		'condition',
		'picture'
	];

	public function pathAttachment()
	{
		return "/images/products/" . $this->picture;
	}

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

	public function setNameAttribute($value){
		
        $this->attributes['name'] = ucfirst((strtolower($value)));
	}

	public function scopeName($query, $name)
	{
		if($name)
		{
			return $query->where('name','LIKE',"%$name%");
		}
	}
}
