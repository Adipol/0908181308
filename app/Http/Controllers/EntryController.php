<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Warehouse;

class EntryController extends Controller
{
    public function index()
    {
        return view('warehouse.entry.index');
    }

    public function create()
    {
        
        $products = DB::table('products')->select('products.id','products.name')
        ->whereIn('products.id',function($query){
            $value = session()->get('warehouse_id');
            $query->select('product_warehouses.product_id')
                ->from('product_warehouses')->where('product_warehouses.warehouse_id','=',$value);
        })->orderBy('products.name','ASC')->get();

        $ucm                   = auth()->user()->name;

        $value                 = session()->get('warehouse_id');
        $warehouse=Warehouse::where('id',$value)->pluck('name')->first();

        return view('warehouse.entry.create')->with(compact('products','ucm','warehouse'));
    }
}
