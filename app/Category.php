<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected static function boot () {
		parent::boot();
		static::creating(function (Category $category) {
			if( ! \App::runningInConsole()) {
				$category->slug = str_slug($category->name,"-");
			}
		});
	}

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
		
        $this->attributes['name'] = mb_strtolower($value);
	}

	public function getNameAttribute($value){
		return ucfirst($value);
	}

	public function setDescriptionAttribute($value){
		
        $this->attributes['description'] = mb_strtolower($value);
	}

	public function getDescriptionAttribute($value){
		return ucfirst($value);
	}
}
