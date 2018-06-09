<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputDetail extends Model
{
    protected $fillable=[
		'output_id',
		'product_id',
        'quantity',
        'condition'
	];

	public function output()
    {
        return $this->belongsTo('App\Output');
	}
}
