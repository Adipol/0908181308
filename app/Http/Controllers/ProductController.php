<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductWarehouse;

class ProductController extends Controller
{
  public function index()
  {
    $ps= ProductWarehouse::with('product.category')->paginate(10);
    
    return view('warehouse.product.index')->with(compact('ps'));
  }

	public function create()
	{
		return view('warehouse.product.create');
	}
}
