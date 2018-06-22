<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    public function index()
    {   
        $user     = auth()->user()->id;
        $associates = DB::table('associates')
        ->join('warehouses','associates.warehouse_id','=','warehouses.id')
        ->where('associates.condition',1)
        ->where('associates.user_id',$user)
        ->select('warehouses.name','warehouses.ubication','associates.condition')
        ->orderBy('warehouses.name','asc')
        ->get();

        return view ('auth.access.index') -> with(compact ('associates'));
    }
}
