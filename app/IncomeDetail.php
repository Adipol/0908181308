<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeDetail extends Model
{
	protected $fillable=[
		'income_id',
		'product_id',
		'quantity'
	];

	public function income()
    {
        return $this->belongsTo('App\Income');
	}
}
