<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Justification;
use App\Http\Requests\JustificationStoreRequest;
use App\Http\Requests\JustificationUpdateRequest;

class JustificationController extends Controller
{
    public function index()
    {
        $justifications=Justification::orderBy('name','asc')->paginate(10);

        return view('admin.justification.index')->with(compact('justifications'));
    }

    public function create()
    {
        return view('admin.justification.create');
    }

    public function store(JustificationStoreRequest $request)
	{	
		$justification       = new Justification();
		$justification->name = $request->get('name');
		$justification->ucm  = auth()->user()->id;
		$justification->save();

		return redirect()->route('justification.index')->with('notification','Justificación ingresada exitosamente.');
    }

    public function edit($id)
    {
        $justification= Justification::find($id);

        return view('admin.justification.edit')->with(compact('justification'));
    }

    public function update(JustificationUpdateRequest $request, $id)
    {
        $justification       = Justification::find($id);
        $justification->name = $request->get('name');
        $justification->ucm  = auth()->user()->id;
        $justification->save();

        return redirect()->route('justification.index')->with('notification','Justificación modificada exitosamente.');
    }

    public function delete($id)
    {
        $justification            = Justification::find($id);
        $justification->condition = 0;
        $justification->ucm       = Auth()->user()->id;
        $justification->save();

        return redirect()->route('justification.index')->with('notification','La justicicación se dio de baja correctamente.');
    }

    public function restore($id)
    {
        $justification            = Justification::find($id);
        $justification->condition = 1;
        $justification->ucm       = Auth()->user()->id;
        $justification->save();

        return redirect()->route('justification.index')->with('notification','La justicicación se dio de alta correctamente.');
    }
}
