<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Output;
use Illuminate\Support\Facades\DB;
use App\Warehouse;
use App\OutputDetail;
use App\Justification;

class RequestController extends Controller
{
    public function index()
    {
        $requests =DB::table('outputs')
        ->join('users','outputs.applicant_id','=','users.id')
        ->select('users.name','outputs.justification','outputs.created_at','outputs.condition')
        ->where('status','REQUESTED')->paginate(10);
     
        return view ('warehouse.output.request.index') -> with(compact ('requests'));

    }


    public function create()
	{
        $value = session()->get('warehouse_id');

        $products=DB::table('products')
        ->join('product_warehouses','products.id','=','product_warehouses.product_id')
        ->where('product_warehouses.condition','=',1)
        ->where('product_warehouses.warehouse_id','=',$value)
        ->select('products.id','products.name','product_warehouses.stock')
        ->get();
        
        $justifications = Justification::where('condition',1)->select('name','id')->orderBy('name','asc')->get();

        $ucm       = auth()->user()->name;
        $value     = session()->get('warehouse_id');
        $warehouse = Warehouse::where('id',$value)->pluck('name')->first();

		return view('warehouse.output.request.create')->with(compact('products','ucm','warehouse','justifications'));
    }

    public function store(Request $request)
    {
         try{
            DB::beginTransaction(); 
            
            $idarticulo = $request->get('product');
            $cantidad   = $request->get('stock');
            
            if ($idarticulo === null) {
                return redirect()->route('request.index')->with('error','No se realizo la solicitud.');
            } else {
                $value = session()->get('warehouse_id');

                $req                = new Output();
                $req->warehouse_id  = $value;
                $req->justification = $request->get('justification');
                $ucm                = auth()->user();
                $req->ucm           = $ucm->id;
                $req->applicant_id  = auth()->user()->id;
                $req->save();

                $total= count($idarticulo);
                $cont=0;

                while ($cont < $total) {
                    $detail             = new OutputDetail();
                    $detail->output_id  = $req->id;
                    $w_p    = ProductWarehouse::with('warehouses')->where('warehouse_id',$value)->where('product_id',$idarticulo[$cont]);
                    $w_p->decrement('stock',$cantidad[$cont]);
                    $detail->product_id = $idarticulo[$cont];
                    $detail->quantity   = $cantidad[$cont];
                    $ucm                = auth()->user();
                    $detail->ucm        = $ucm->id;
                    $detail->save();
                    $cont = $cont+1;
                } 
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('request.index')->with('notification','Solicitud se realizo exitosamente.');
    }
}
