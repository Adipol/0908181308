<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Output;
use Illuminate\Support\Facades\DB;
use App\Warehouse;
use App\OutputDetail;
use App\Justification;
use App\ProductWarehouse;
use App\Http\Requests\RequestStoreRequest;

class RequestController extends Controller
{
    public function index()
    {
        $user     = auth()->user()->id;
        $value    = session()->get('warehouse_id');
        $requests = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->select('outputs.id','outputs.created_at','users.name','warehouses.name as w_name','outputs.condition')
        ->where('outputs.warehouse_id',$value)
        ->where('outputs.applicant_id',$user)
        ->where('outputs.status','REQUESTED')
        ->where('outputs.condition',1)
        ->orderBy('outputs.id','desc')
        ->paginate(10);
     
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

    public function store(RequestStoreRequest $request)
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
                $req->description_j = $request->get('description');
                $req->ucm           = auth()->user()->id;
                $req->applicant_id  = auth()->user()->id;
                $req->save();

                $req->justifications()->attach($request->get('justifications'));

                $total = count($idarticulo);
                $cont  = 0;

                while ($cont < $total) {
                    $detail            = new OutputDetail();
                    $detail->output_id = $req->id;
                    $w_p               = ProductWarehouse::with('warehouses')->where('warehouse_id',$value)->where('product_id',$idarticulo[$cont]);
                    $w_p->decrement('stock',$cantidad[$cont]);
                    $detail->product_id = $idarticulo[$cont];
                    $detail->quantity   = $cantidad[$cont];
                    $detail->ucm        = auth()->user()->id;
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

    public function show($id)
    {
      $sol = DB::table('outputs')
        ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
        ->join('users','outputs.applicant_id','=','users.id')
        ->where('outputs.id','=',$id)
        ->select('outputs.created_at','warehouses.name as w_name','users.name as u_name','outputs.description_j')
        ->first();

        $output         = Output::find($id);
        $justifications = $output->justifications;
        
        $products = DB::table('products')
        ->join('categories','products.category_id','=','categories.id')
        ->join('output_details','products.id','=','output_details.product_id')
        ->join('outputs','output_details.output_id','=','outputs.id')
        ->where('outputs.id','=',$id)
        ->select('products.name as p_name','categories.name as c_name','output_details.quantity')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.output.request.show')->with(compact('sol','products','justifications')); 
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction(); 

                $entry            = Output::find($id);
                $entry->condition = 0;
                $ucm              = auth()->user();
                $entry->ucm       = $ucm->id;
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

        return redirect()->route('request.index')->with('notification','Solicitud se anulo exitosamente.');
    }
}
