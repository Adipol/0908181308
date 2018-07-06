<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Output;
use App\Justification;

class JustificationController extends Controller
{
    public function index()
    {   
        $user     = auth()->user()->id;
        if (session('justification_id')) {
            $requests = DB::table('outputs')
            ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
            ->join('users','outputs.applicant_id','=','users.id')
            ->join('justification_output','outputs.id','=','justification_output.output_id')
            ->select('outputs.id','outputs.created_at','users.name','warehouses.name as w_name','outputs.condition','outputs.status')
            ->whereBetween('outputs.created_at',[session('from'),session('to')])
            ->where('justification_output.justification_id',session('justification_id'))
            ->whereIn('outputs.status',['APPROVED','DELIVERED'])
            ->where('outputs.condition',1)
            ->where('approve',$user)
            ->orderBy('outputs.id','asc')
            ->paginate(10);
        } else {
            $requests = DB::table('outputs')
            ->join('warehouses','outputs.warehouse_id','=','warehouses.id')
            ->join('users','outputs.applicant_id','=','users.id')
            ->join('justification_output','outputs.id','=','justification_output.output_id')
            ->select('outputs.id','outputs.created_at','users.name','warehouses.name as w_name','outputs.condition','outputs.status')
            ->whereBetween('outputs.created_at',[session('from'),session('to')])
            ->whereIn('outputs.status',['APPROVED','DELIVERED'])
            ->where('outputs.condition',1)
            ->where('approve',$user)
            ->orderBy('outputs.id','asc')
            ->paginate(10);
        }
        
        $justifications = DB::table('justifications')
        ->join('justification_output','justifications.id','=','justification_output.justification_id')
        ->join('outputs','justification_output.output_id','=','outputs.id')
        ->where('outputs.warehouse_id',session('warehouse_id'))
        ->select('justifications.id','justifications.name') 
        ->distinct('justifications.id')  
        ->orderBy('justifications.name','asc')      
        ->get();

        return view ('warehouse.justification.index') -> with(compact ('requests','justifications'));
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
        ->where('output_details.quantity','>',0)
        ->select('products.id','products.name as p_name','categories.name as c_name','output_details.quantity','units.name as unit_name')
        ->orderBy('products.name','asc')
        ->get();

        return view('warehouse.justification.show')->with(compact('sol','products','justifications')); 
    }

    public function search()
    {
        if(request()->isMethod('POST')){
            $from             = request('from');
            $to               = request('to');
            $justification_id = request('justification_id');
            
            if($from && $to){
                request()->session()->put('from',$from);
                request()->session()->put('to',$to);
                request()->session()->put('justification_id',$justification_id);
                request()->session()->save();
            } else{
                request()->session()->forget('from');
                request()->session()->forget('to');
                request()->session()->forget('justification_id');
            }
        }

        return redirect('/reporte/justificaciones');
    }

    public function clearSearch()
    {
        request()->session()->forget('from');
        request()->session()->forget('to');
        request()->session()->forget('justification_id'); 

        return back();
    }
}
