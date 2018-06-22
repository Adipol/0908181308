<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Warehouse;
use App\IncomeDetail;
use App\Income;
use App\ProductWarehouse;
use App\Http\Requests\EntryStoreRequest;

class EntryController extends Controller
{
    public function index()
    {
        $value   = session()->get('warehouse_id');
        $incomes = DB::table('incomes')
        ->join('users','incomes.responsable_id','=','users.id')
        ->join('warehouses','incomes.warehouse_id','=','warehouses.id')
        ->where('incomes.warehouse_id','=',$value)
        ->select('incomes.id','users.name as responsable','incomes.created_at as inc_created','incomes.condition as inc_condition')
        ->orderBy('incomes.id','DESC')
        ->paginate(10);

        return view('warehouse.entry.index')->with(compact('incomes'));
    }

    public function create()
    {
        $products = DB::table('products')
        ->join('units','products.unit_id','=','units.id')
        ->select('products.id','products.name',DB::raw("CONCAT(products.name,'  (',units.name,')') as fullProduct"))
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

    public function store(EntryStoreRequest $request)
    {
         try{
            DB::beginTransaction(); 
            
            $idarticulo = $request->get('product');
            $cantidad   = $request->get('stock');
            
            if ($idarticulo === null) {
                return redirect()->route('entry.index')->with('error','No se pudo realizar el ingreso.');
            } else {
                $value = session()->get('warehouse_id');

                $entry                = new Income();
                $entry->warehouse_id  = $value;
                $ucm                  = auth()->user();
                $entry->ucm           = $ucm->id;
                $entry->responsable_id = auth()->user()->id;
                $entry->save();

                $total= count($idarticulo);
                $cont=0;

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
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('entry.index')->with('notification','Ingreso de productos exitosamente.');
    }

    public function show($id)
    {
        $value = session()->get('warehouse_id');

        $entry=DB::table('incomes')
        ->join('users','incomes.responsable_id','=','users.id')
        ->join('income_details','incomes.id','=','income_details.income_id')
        ->join('warehouses','incomes.warehouse_id','=','warehouses.id')
        ->select('incomes.id','incomes.created_at','users.name','warehouses.name as wa_name')
        ->where('incomes.id','=',$id)
        ->where('incomes.warehouse_id','=',$value)
        ->first();
    
        $details=DB::table('income_details')
        ->join('products','income_details.product_id','=','products.id')
        ->join('units','products.unit_id','=','units.id')
        ->join('categories','products.category_id','=','categories.id')
        ->select('products.name','categories.name as c_name','income_details.quantity','units.name as unit_name')
        ->where('income_details.income_id','=',$id)
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.entry.show')->with(compact('entry','details'));         
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction(); 

                $entry            = Income::find($id);
                $entry->condition = 0;
                $ucm              = auth()->user();
                $entry->ucm       = $ucm->id;
                $ware             = $entry->warehouse_id;
                $entry->save();

                $total = IncomeDetail::where('income_id',$id)->get(); 
                
                foreach ($total as $unique) {
                    $w_p = ProductWarehouse::with('warehouses')->where('warehouse_id',$ware)->where('product_id',$unique->product_id);
                    $w_p->decrement('stock',$unique->quantity);
                    $unique->condition=0;
                    $unique->save();
                } 
            
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('entry.index')->with('notification','Ingreso se anulo exitosamente.');
    }
}
