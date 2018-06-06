<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Warehouse;
use App\IncomeDetail;
use App\Income;
use App\ProductWarehouse;

class EntryController extends Controller
{
    public function index()
    {
        $incomes=DB::table('incomes')
                    ->join('users','incomes.responsable_id','=','users.id')
                    ->select('users.name as responsable','incomes.created_at as inc_created','incomes.condition as inc_condition')->get();
        return view('warehouse.entry.index')->with(compact('incomes'));
    }

    public function create()
    {
        
        $products = DB::table('products')->select('products.id','products.name')
        ->whereIn('products.id',function($query){
            $value = session()->get('warehouse_id');
            $query->select('product_warehouses.product_id')
                ->from('product_warehouses')->where('product_warehouses.warehouse_id','=',$value);
        })->orderBy('products.name','ASC')->get();

        $ucm                   = auth()->user()->name;

        $value                 = session()->get('warehouse_id');
        $warehouse=Warehouse::where('id',$value)->pluck('name')->first();

        return view('warehouse.entry.create')->with(compact('products','ucm','warehouse'));
    }

    public function store(Request $request)
    {
         try{
            DB::beginTransaction(); 
            
            $value = session()->get('warehouse_id');

            $entry                = new Income();
            $entry->warehouse_id  = $value;
            $ucm                  = auth()->user();
            $entry->ucm           = $ucm->id;
            $entry->responsable_id = auth()->user()->id;
            $entry->save();

            $idarticulo = $request->get('product');
            $cantidad   = $request->get('stock');
            $total= count($idarticulo);
            $cont=0;
            dd($total);
            while ($cont < $total) {
                $detail = new IncomeDetail();
                $w_p    = ProductWarehouse::with('warehouses')->where('warehouse_id',$value)->where('product_id',$idarticulo[$cont]);
                $w_p->increment('stock',$cantidad[$cont]);
                $detail->income_id  = $entry->id;
                $detail->product_id = $idarticulo[$cont];
                $detail->quantity   = $cantidad[$cont];
                $ucm                = auth()->user();
                $detail->ucm        = $ucm->id;
                $detail->save();
                $cont = $cont+1;
            } 

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('entry.index')->with('notification','Ingreso de productos exitosamente.');
    }
}
