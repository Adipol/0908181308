<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Output;

class TracingDeliverController extends Controller
{
    public function index()
    {   
        $deliver_id = auth()->user()->id;
        $requests =DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->select('outputs.id','users.name','justifications.name as j_name','outputs.description_j','outputs.created_at','outputs.status','warehouses.name as w_name','outputs.condition','outputs.voucher')
        ->where('outputs.deliver','=', $deliver_id)
        ->where('outputs.status','=','DELIVERED')
        ->orderBy('outputs.id','desc')
        ->paginate(10);

        return view ('warehouse.tracing.deliver.index') -> with(compact ('requests'));
    }

    public function show($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.created_at','warehouses.name as w_name','users.name as u_name','justifications.name as j_name','outputs.description_j','outputs.status','outputs.voucher')
        ->first();
        
        $products = DB::table('products')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.tracing.deliver.show')->with(compact('sol','products')); 
    }

    public function edit($id)
	{
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.id','outputs.created_at','warehouses.name as w_name','users.name as u_name','justifications.name as j_name','outputs.description_j','outputs.status','outputs.voucher')
        ->first();
        
        $products = DB::table('products')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.tracing.deliver.edit')->with(compact('sol','products')); 
	}

	public function update(Request $request,$id)
	{
        $deliver              = Output::find($id);
        $deliver->description_j = $request->get('description_j');

        if ($request->hasFile('voucher')) {
            $extension = $request->file('voucher')->getClientOriginalExtension();
            $file_name = $id . '.' . time() . '.' . $extension;
            Image:: make($request->file('voucher'))
            ->resize(350,500)
            ->save('img/delivered/' . $file_name);
            $deliver->voucher = $file_name;
        }
        $deliver->ucm = auth()->user()->id;
        $deliver->save();

        return redirect()->route('tdeliver.index')->with('notification','Entrega actualizada exitosamente.');  
	}
}