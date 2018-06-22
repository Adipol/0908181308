<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Output;
use Carbon\Carbon;
use App\OutputDetail;
use App\ProductWarehouse;
use App\Http\Requests\ApproveUpdateRequest;

class ApproveController extends Controller
{
    public function index()
    {
        $value    = session()->get('warehouse_id');
        $requests = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->select('outputs.id','outputs.created_at','users.name','warehouses.name as w_name','outputs.condition')
        ->where('outputs.warehouse_id',$value)
        ->where('outputs.status','REQUESTED')
        ->where('outputs.condition',1)
        ->orderBy('outputs.id','desc')
        ->paginate(10);
     
        return view ('warehouse.output.approve.index') -> with(compact ('requests'));
    }

    public function edit($id)
    {
        $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.id','outputs.created_at','warehouses.name as w_name','users.name as u_name','outputs.description_j','outputs.condition')
        ->first();

        $output         = Output::find($id);
        $justifications = $output->justifications;
        
        $products = DB::table('products')
        ->join('units','products.unit_id','=','units.id')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity','units.name as unit_name')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.output.approve.edit')->with(compact('sol','products','justifications')); 
    }

    public function update(ApproveUpdateRequest $request,$id)
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
                if ($quantity[$cont]>=$real[$cont]) {
                    $actual = $quantity[$cont]-$real[$cont];
                    $w_p->increment('stock',$actual);
                    $detail->quantity = $real[$cont];
                    $detail->ucm      = auth()->user()->id;
                    $detail->save();
                    $cont = $cont+1;
                }
                else {
                    return redirect()->route('approve.index')->with('error','No se realizo la operación.');
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('approve.index')->with('notification','Solicitud aprobada exitosamente.');        
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction(); 

                $entry            = Output::find($id);
                $entry->condition = 0;
                $entry->ucm       = auth()->user()->id;
                $ware             = $entry->warehouse_id;
                $entry->save();

                $total = OutputDetail::where('output_id',$id)->get(); 
                
                foreach ($total as $unique) {
                    $w_p = ProductWarehouse::with('warehouses')->where('warehouse_id',$ware)->where('product_id',$unique->product_id);
                    $w_p->increment('stock',$unique->quantity);
                    $unique->condition=0;
                    $unique->save();
                } 
            
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('approve.index')->with('notification','Solicitud se anulo exitosamente.');
    }
}
