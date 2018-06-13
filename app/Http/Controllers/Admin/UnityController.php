<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unit;
use App\Http\Requests\UnityStoreRequest;

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
}
