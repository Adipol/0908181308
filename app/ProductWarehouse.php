<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    protected $fillable=[
        'product_id',
        'stock',
        'condition'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
