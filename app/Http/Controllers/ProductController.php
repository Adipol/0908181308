<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\ProductWarehouse;
use App\Unit;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductWarehouseStoreRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function index()
  { 
    $value = session()->get('warehouse_id');

    $ps= ProductWarehouse::where('warehouse_id',$value)->with('product.category')->paginate(10);

    return view('warehouse.product.index')->with(compact('ps'));
  }

	public function create()
	{
        $products = Product::all();

		return view('warehouse.product.create')->with(compact('products'));
  }
  
  public function store(Request $request)
  {   
      $value                 = session()->get('warehouse_id');
      $product               = new ProductWarehouse;
      $product->product_id   = $request->get('idarticulo');
      $product->warehouse_id = $value;
      $product->stock        = $request->get('cantidad');
      $product->condition    = 1;
      $ucm                   = auth()->user();
      $product->ucm          = $ucm->id;
      $product->save();

      return redirect()->route('product.index')->with('notification','Producto agregado exitosamente.');
  }

  public function add()
  {   
    $categories=Category::where('condition',1)->get();
    $units=Unit::where('condition',1)->get();

    return view('warehouse.product.add')->with(compact('categories','units'));
  }

  public function storep(ProductStoreRequest $request,ProductWarehouseStoreRequest $request1)
  {   
    try{
        DB::beginTransaction();

        $product              = new Product();
        $product->category_id = $request->get('category_id');
        $product->name        = $request->get('name');
        $product->unit_id     = $request->get('unit_id');
        $product->image       = $request->get('image');
        $product->description = $request->get('description');
        $product->condition   = 1;
        $ucm                  = auth()->user();
        $product->ucm         = $ucm->id;
        $product->save();
  
        $value              = session()->get('warehouse_id');
        $proc               = new ProductWarehouse();
        $proc->product_id   = $product->id;
        $proc->warehouse_id = $value;
        $proc->stock        = $request1->get('stock');
        $proc->condition    = 1;
        $proc->ucm          = $ucm->id;
        $proc->save();
        
        DB::commit();
    } catch(Exception $e){
        DB::rollback();
    }
    
    return redirect()->route('product.index')->with('notification','Producto agregado exitosamente.');
  }
}
