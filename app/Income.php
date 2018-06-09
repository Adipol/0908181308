<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
	protected $fillable=[
		'user_id',
		'justification',
		'created_at'
	];

	public function warehouse()
	{
		return $this->belongsTo('App\Warehouse');
	}
	
	public function incomeDetails()
	{
		return $this->hasMany('App\IncomeDetail');
	}
}
