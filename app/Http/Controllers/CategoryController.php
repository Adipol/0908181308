<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	public function index()
	{
		$categories=Category::where('condition','1')->paginate(15);
		return view('warehouse.category.index')->with(compact('categories'));
		
	}

	public function create()
	{
		return view('warehouse.category.create');
	}
}
