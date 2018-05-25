<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	public function index()
	{
		$categories=Category::paginate(10);
		return view('warehouse.category.index')->with(compact('categories'));
	}

	public function store(Request $request)
	{	
		$messages = [
			'name.required'   => 'Es necesario ingresar el nombre.'
		];

		$validator=\Validator::make($request->all(),[
			'name'        => 'required|min:3|max:50|unique:categories,name'
		],$messages);
		
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

		$category              = new Category();
		$category->name        = $request->get('name');
		$category->description = $request->get('description');
		$ucm                   = auth()->user();
		$category->ucm         = $ucm->id;
		$category->save();

		return response()->json(['success'=>'Registro ingresado exitosamente.']);
	}
}
