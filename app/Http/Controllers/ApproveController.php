<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Output;
use Carbon\Carbon;
use App\OutputDetail;
use App\ProductWarehouse;

class ApproveController extends Controller
{
    public function index()
    {
        $requests =DB::table('outputs')
        ->join('users','outputs.applicant_id','=','users.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->select('outputs.id','users.name','justifications.name as j_name','outputs.created_at','outputs.condition')
        ->where('status','REQUESTED')
        ->orderBy('outputs.id','desc')
        ->paginate(10);

        return view('warehouse.output.approve.index')->with(compact('requests'));
    }

    public function show($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.created_at','warehouses.name as w_name','users.name as u_name','justifications.name as j_name','outputs.description_j')
        ->first();
        
        $products = DB::table('products')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.output.approve.show')->with(compact('sol','products')); 
    }

    public function edit($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('justifications','outputs.justification_id','=','justifications.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.id','outputs.created_at','warehouses.name as w_name','users.name as u_name','justifications.name as j_name','outputs.description_j')
        ->first();

        $products = DB::table('products')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.output.approve.edit')->with(compact('sol','products')); 
    }

    public function update(Request $request,$id)
    {
        try{
            DB::beginTransaction(); 
            $approve                   = Output::find($id);
            $approve->approve          = auth()->user()->id;
            $approve->date_to_approved = Carbon::now();
            $approve->status           = 'APPROVED';
            $approve->save();

            $warehouse  = $approve->warehouse_id;
            $idarticulo = $request->get('product');
            $quantity   = $request->get('quantity');
            $real       = $request->get('real');

            $total= count($idarticulo);
            $cont=0;

            while ($cont < $total) {
                $detail = OutputDetail::where('output_id','=',$id)->where('product_id','=',$idarticulo[$cont])->first();
                $w_p    = ProductWarehouse::with('warehouses')->where('warehouse_id',$warehouse)->where('product_id',$idarticulo[$cont]);
                $actual = $quantity[$cont]-$real[$cont];
                $w_p->increment('stock',$actual);
                $detail->quantity = $real[$cont];
                $detail->ucm      = auth()->user()->id;
                $detail->save();
                $cont = $cont+1;
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('approve.index')->with('notification','Solicitud aprobada exitosamente.');        
    }
}
