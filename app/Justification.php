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
}
