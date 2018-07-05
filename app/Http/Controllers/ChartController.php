<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductWarehouse;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        $value = session()->get('warehouse_id');

        $products = DB::table('output_details')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->join('products','output_details.product_id','=','products.id')
        ->where('outputs.warehouse_id',$value)
        ->select('products.name', DB::raw('SUM(quantity) as total'))
	    ->groupBy('products.name') 
        ->get();

        $stocks = DB::table('product_warehouses')
        ->join('products','product_warehouses.product_id','=','products.id')
        ->where('product_warehouses.warehouse_id',$value)
        ->select('products.name','product_warehouses.stock')
        ->orderBy('product_warehouses.stock','asc')
        ->get();

        return view('warehouse.chart.index')->with(compact('products','stocks'));        
    }
}
