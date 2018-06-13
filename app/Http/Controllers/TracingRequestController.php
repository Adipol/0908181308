<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TracingRequestController extends Controller
{
    public function index()
    {
        $applicant_id = auth()->user()->id;
        $requests =DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->select('outputs.id','users.name','justifications.name as j_name','outputs.created_at','outputs.status','warehouses.name as w_name','outputs.condition')
        ->where('outputs.applicant_id','=', $applicant_id)
        ->orderBy('outputs.id','desc')
        ->paginate(10);

        return view ('warehouse.tracing.request.index') -> with(compact ('requests'));
    }

    public function show($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.created_at','warehouses.name as w_name','users.name as u_name','justifications.name as j_name','outputs.description_j','outputs.status')
        ->first();
        
        $products = DB::table('products')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.tracing.request.show')->with(compact('sol','products')); 
    }
}
