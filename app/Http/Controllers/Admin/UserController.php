<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Rol;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\DB;

use App\Warehouse;
use App\Associate;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->where('id','<>',1)->orderBy('name','asc')->with('rol')->paginate(10);
        
        return view('admin.user.index')->with(compact('users'));
    }

    public function create()
    {
        $rols = Rol::select('name','id')->orderby('name','asc')->get();

        return view('admin.user.create')->with(compact('rols'));
    }

    public function store(UserStoreRequest $request)
	{	
		$user        = new User();
		$user->name  = $request->get('name');
		$user->email = $request->get('email');
		$password    = $request->get('password');
		
        if ($password)
        {
            $user->password = bcrypt($password);
        }

        $user->rol_id = $request->get('rol_id');
		$user->save();

		return redirect()->route('user.index')->with('notification','Usuario ingresado exitosamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $rols = Rol::select('id','name')->orderby('name','asc')->get();

        return view('admin.user.edit')->with(compact('user','rols'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user         = User::findOrFail($id);
        $user->name   = $request->get('name');
        $user->rol_id = $request->get('rol_id');
        $user->save();

        return redirect()->route('user.index')->with('notification','Usuario modificado exitosamente.');
    }
    
    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user.index')->with('notification','El usuario se dio de baja correctamente.');
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('user.index')->with('notification','El usuario se dio de alta correctamente.');
    }

    public function associate($id)
    {
        $user = DB::table('users')
        ->join('rols','users.rol_id','=','rols.id')
        ->where('users.id',$id)
        ->select('users.id','users.name','users.email','rols.name as r_name')
        ->first();

        $warehouses=DB::table('warehouses')->select('warehouses.id','warehouses.name')
        ->whereNotIn('warehouses.id',function($query)use ($id){
            $query->select('associates.warehouse_id')
            ->from('associates')
            ->where('associates.user_id','=',$id);
        })->orderBy('warehouses.name','asc')->get();

        return view('admin.user.associate')->with(compact('user','warehouses'));
    }

    public function updateAssociate(Request $request, $id)
    {
        $idwarehouse=$request->get('warehouse');
        if ($idwarehouse === null) {
            return redirect()->route('user.index')->with('error','No se puede realizar la operación.');
        } else {
            $total = count($idwarehouse);
            $cont  = 0;

            while ($cont < $total) {
                $associate               = new Associate();
                $associate->user_id      = $id;
                $associate->warehouse_id = $idwarehouse[$cont];
                $associate->ucm          = Auth()->user()->id;
                $associate->save();
                $cont=$cont+1;
            }
        }

        return redirect()->route('user.index')->with('notification','Se completo la asociación correctamente.');
    }
    
    public function disassociate($id)
    {
        $user = DB::table('users')
        ->join('rols','users.rol_id','=','rols.id')
        ->where('users.id',$id)
        ->select('users.id','users.name','users.email','rols.name as r_name')
        ->first();

        $warehouses=DB::table('warehouses')
        ->join('associates','warehouses.id','=','associates.warehouse_id')
        ->join('users','associates.user_id','=','users.id')
        ->select('warehouses.id','warehouses.name','associates.condition')
        ->where('users.id',$id)
        ->orderBy('warehouses.name','asc')
        ->get();

        return view('admin.user.disassociate')->with(compact('user','warehouses'));
    }

    public function updateDisassociate(Request $request,$id)
    {
        try{
            DB::beginTransaction(); 

            $warehouse = $request->get('warehouse');
            $condition   = $request->get('condition');

            $total= count($warehouse);
            $cont=0;

            while ($cont < $total) {
                $detail            = Associate::where('user_id',$id)->where('warehouse_id',$warehouse[$cont])->first();
                $detail->condition = $condition[$cont];
                $detail->ucm       = auth()->user()->id;
                $detail->save();
                $cont = $cont+1;
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

        return redirect()->route('user.index')->with('notification','Solicitud aprobada exitosamente.');        
    }
}
