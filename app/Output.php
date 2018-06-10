<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    protected $fillable=[
        'warehouse_id',
        'applicant_id',
        'justification_id',
        'description_j',
        'observation',
        'status',
        'voucher',
        'approve',
        'date_to_approved',
        'deliver',
        'date_to_delivered',
        'condition',
        'created_at'
    ];

    public function warehouse()
	{
		return $this->belongsTo('App\Warehouse');
    }
    
    public function outputDetails()
	{
		return $this->hasMany('App\OutputDetail');
    }
    
    public function justification()
    {
        return $this->belongsTo('App\Justification');
	}
}