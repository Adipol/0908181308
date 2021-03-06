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
		'picture',
	];

	public function setNameAttribute($value){
		
        $this->attributes['name'] = mb_strtolower($value);
	}

	public function setDescriptionAttribute($value){
		
        $this->attributes['description'] = mb_strtolower($value);
	}

	public function getDescriptionAttribute($value)
	{
		return ucfirst($value);
	}

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

	public function scopeName($query, $name)
	{
		if($name)
		{
			return $query->where('name','LIKE',"%$name%");
		}
	}
}
