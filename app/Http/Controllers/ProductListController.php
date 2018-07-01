<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
class ProductListController extends Controller
{
    public function index(Request $request)
    {

        $value       = session()->get('warehouse_id');
        $name        = $request->get('name');

        $products=DB::table('products')
        ->join('categories','products.category_id','=','categories.id')
        ->join('product_warehouses','products.id','=','product_warehouses.product_id')
        ->where('products.name','LIKE',"%$name%")
        ->where('product_warehouses.condition','=',1)
        ->where('product_warehouses.warehouse_id','=',$value)
        ->select('products.id','products.name','categories.name as c_name','product_warehouses.stock','product_warehouses.condition')
        ->orderBy('products.name','asc')
        ->paginate(10);

        $categories=Category::where('condition',1)->get();

        return view ('auth.product.index') -> with(compact ('products','categories'));
    }

    public function show($id)
    {
        $value = session()->get('warehouse_id');
    
        $product=DB::table('products')
        ->join('product_warehouses','products.id','=','product_warehouses.product_id')
        ->join('categories','products.category_id','=','categories.id')
        ->join('units','products.unit_id','=','units.id')
        ->where('products.id',$id)
        ->where('product_warehouses.warehouse_id',$value)
        ->select('categories.name as cat_name','products.name as prod_name','units.name as unit_name','product_warehouses.stock','products.description as prod_des','products.picture as picture')
        ->first();
   
        return view('auth.product.show')->with(compact('product'));
    } 
}
