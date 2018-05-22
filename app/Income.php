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

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function incomeDetails()
	{
		return $this->hasMany('App\IncomeDetail');
	}
}
