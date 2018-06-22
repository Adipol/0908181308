<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Output;

class TracingRequestController extends Controller
{
    public function index()
    {
        $user     = auth()->user()->id;
        $requests = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->select('outputs.id','outputs.created_at','users.name','warehouses.name as w_name','outputs.condition','outputs.status')
        ->where('outputs.applicant_id',$user)
        ->orderBy('outputs.id','desc')
        ->paginate(10);

        return view ('warehouse.tracing.request.index') -> with(compact ('requests'));
    }

    public function show($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.id','outputs.created_at','warehouses.name as w_name','users.name as u_name','outputs.description_j','outputs.condition','outputs.status')
        ->first();

        $output         = Output::find($id);
        $justifications = $output->justifications;
        
        $products = DB::table('products')
        ->join('units','products.unit_id','=','units.id')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity','units.name as u_name')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.tracing.request.show')->with(compact('sol','products','justifications')); 
    }
}
