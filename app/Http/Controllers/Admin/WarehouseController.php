<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Warehouse;

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

    public function store(Request $request)
	{	
		$warehouse            = new Warehouse();
		$warehouse->name      = $request->get('name');
		$warehouse->ubication = $request->get('ubication');
		$warehouse->ucm       = auth()->user()->id;
		$warehouse->save();

		return redirect()->route('warehouse.index')->with('notification','Almacen ingresado exitosamente.');
	}
}
