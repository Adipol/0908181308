<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unit;
use App\Http\Requests\UnityStoreRequest;
use App\Http\Requests\UnityUpdateRequest;

class UnityController extends Controller
{
    public function index()
    {
        $units= Unit::orderBy('name','asc')->paginate(10);

        return view('admin.unity.index')->with(compact('units'));
    }

    public function create()
    {
        return view('admin.unity.create');
    }

    public function store(UnityStoreRequest $request)
	{	
		$unity               = new Unit();
		$unity->name         = $request->get('name');
		$unity->abbreviation = $request->get('abbreviation');
		$unity->ucm          = auth()->user()->id;
		$unity->save();

		return redirect()->route('unity.index')->with('notification','Medida ingresada exitosamente.');
    }

    public function edit($id)
    {
        $unity= Unit::find($id);

        return view('admin.unity.edit')->with(compact('unity'));
    }

    public function update(UnityUpdateRequest $request, $id)
    {
        $unity               = Unit::find($id);
        $unity->name         = $request->get('name');
        $unity->abbreviation = $request->get('abbreviation');
        $unity->ucm          = Auth()->user()->id;
        $unity->save();

        return redirect()->route('unity.index')->with('notification','Medida modificada exitosamente.');
    }

    public function delete($id)
    {
        $unity= Unit::find($id);
        $unity->condition=0;
        $unity->ucm=Auth()->user()->id;
        $unity->save();

        return redirect()->route('unity.index')->with('notification','La medida se dio de baja correctamente.');
    }

    public function restore($id)
    {
        $unity=Unit::find($id);
        $unity->condition=1;
        $unity->ucm=Auth()->user()->id;
        $unity->save();

        return redirect()->route('unity.index')->with('notification','La medida se dio de alta correctamente.');
    }
}
