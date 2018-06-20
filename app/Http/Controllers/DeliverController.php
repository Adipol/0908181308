<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Output;
use Carbon\Carbon;
use App\Http\Requests\DeliverUpdateRequest;

class DeliverController extends Controller
{
    public function index()
    { 
        $requests = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->select('outputs.id','outputs.created_at','users.name','warehouses.name as w_name','outputs.condition','outputs.status')
        ->where('outputs.status','APPROVED')
        ->where('outputs.condition',1)
        ->orderBy('outputs.id','desc')
        ->paginate(10);
        
        return view('warehouse.output.deliver.index')->with(compact('requests'));
    }

    public function edit($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.id','outputs.created_at','warehouses.name as w_name','users.name as u_name')
        ->first();

        $products = DB::table('products')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.output.deliver.edit')->with(compact('sol','products')); 
    }

    public function update(DeliverUpdateRequest $request,$id)
    {   
            $deliver                    = Output::find($id);
            $deliver->observation       = $request->get('observation');

            if ($request->hasFile('voucher')) {
                $extension=$request->file('voucher')->getClientOriginalExtension();
                $file_name= $id . '.' . time() . '.' . $extension;
                Image::make($request->file('voucher'))
                ->resize(350,500)
                ->save('img/delivered/' . $file_name);
                $deliver->voucher=$file_name;
            }
            $deliver->deliver           = auth()->user()->id;
            $deliver->date_to_delivered = Carbon::now();
            $deliver->status            = 'DELIVERED';
            $deliver->ucm               = auth()->user()->id;
            $deliver->save();

        return redirect()->route('deliver.index')->with('notification','Productos entregados exitosamente.');        
    }
}
