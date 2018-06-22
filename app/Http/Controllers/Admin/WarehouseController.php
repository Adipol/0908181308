<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Warehouse;
use App\Http\Requests\WarehouseStoreRequest;
use App\Http\Requests\WarehouseUpdateRequest;


class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::orderBy('name','asc')->paginate(10);
        
        return view('admin.warehouse.index')->with(compact('warehouses'));
    }

    public function create()
    {
        return view('admin.warehouse.create');
    }

    public function store(WarehouseStoreRequest $request)
	{	
		$warehouse            = new Warehouse();
		$warehouse->name      = $request->get('name');
		$warehouse->ubication = $request->get('ubication');
		$warehouse->ucm       = auth()->user()->id;
		$warehouse->save();

		return redirect()->route('warehouse.index')->with('notification','Almacen ingresado exitosamente.');
    }
    
    public function edit($id)
    {
        $warehouse = Warehouse::find($id);

        return view('admin.warehouse.edit')->with(compact('warehouse'));
    }

    public function update(WarehouseUpdateRequest $request, $id)
    {
        $warehouse            = Warehouse::find($id);
        $warehouse->name      = $request->get('name');
        $warehouse->ubication = $request->get('ubication');
        $warehouse->ucm       = Auth()->user()->id;
        $warehouse->save();

        return redirect()->route('warehouse.index')->with('notification','Almacen modificado exitosamente.');
    }

    public function delete($id)
    {
        $warehouse= Warehouse::find($id);
        $warehouse->condition=0;
        $warehouse->ucm=Auth()->user()->id;
        $warehouse->save();

        return redirect()->route('warehouse.index')->with('notification','El almacen se dio de baja correctamente.');
    }

    public function restore($id)
    {
        $warehouse=Warehouse::find($id);
        $warehouse->condition=1;
        $warehouse->ucm=Auth()->user()->id;
        $warehouse->save();

        return redirect()->route('warehouse.index')->with('notification','El almacen se dio de alta correctamente.');
    }
}
