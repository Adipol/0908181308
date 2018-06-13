<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Category;

class CategoryController extends Controller
{
	public function index()
	{
		$categories=Category::orderBy('name','asc')->paginate(10);
		return view('warehouse.category.index')->with(compact('categories'));
	}

	public function create()
	{
		return view('warehouse.category.create');
	}

	public function store(CategoryStoreRequest $request)
	{	
		$category              = new Category();
		$category->name        = $request->get('name');
		$category->description = $request->get('description');
		$category->ucm         = auth()->user()->id;
		$category->save();

		return redirect()->route('category.index')->with('notification','Categoria ingresada exitosamente.');
	}

	public function edit($id)
	{
		$category=Category::find($id);
		
		return view('warehouse.category.edit')->with(compact('category'));
	}

	public function update(CategoryUpdateRequest $request,$id)
	{
		$category              = Category::find($id);
		$category->name        = $request->get('name');
		$category->description = $request->get('description');
		$ucm                   = auth()->user();
		$category->ucm         = $ucm->id;
		$category->save();

		return redirect()->route('category.index')->with('notification','Categoria modificada exitosamente.');
	}

	public function delete($id){

		$category = Category::find($id);
		
		$category->condition = 0;
		$ucm                 = auth()->user();
		$category->ucm       = $ucm->id;
		$category->save();

		return redirect()->route('category.index')->with('notification','La categoria se dio de baja correctamente.');
	}
}
