<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    protected $fillable=[
        'condition'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
