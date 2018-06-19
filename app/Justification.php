<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    protected static function boot () {
		parent::boot();
		static::creating(function (Justification $justification) {
			if( ! \App::runningInConsole()) {
				$justification->slug = str_slug($justification->name,"-");
			}
		});
    }
    
    protected $fillable=[
        'id',
        'name',
        'slug'
    ];

    public function outputs()
    {
        return $this->belongsToMany('App\Output');
    }

    public function setNameAttribute($value){
		
        $this->attributes['name'] = ucfirst((strtolower($value)));
    }
    
}