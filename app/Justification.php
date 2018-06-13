<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    protected $fillable=[
        'name'
    ];

    public function outputs()
    {
        return $this->hasMany('App\outputs');
    }

    public function setNameAttribute($value){
		
        $this->attributes['name'] = ucfirst((strtolower($value)));
	}
}
