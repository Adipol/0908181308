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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductStorepRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductWarehouseUpdateRequest;
class ProductController extends Controller
{
    public function index()
    { 
        $value  = session('warehouse_id');
        $search = session('search');

        $products=DB::table('product_warehouses')
                ->join('products','product_warehouses.product_id','=','products.id')
                ->join('categories','products.category_id','=','categories.id')
                ->where('product_warehouses.warehouse_id','=',$value)
                ->where('products.name','LIKE',"%$search%")
                ->orderBy('products.name','asc')
                ->select('products.id as prod_id','products.name as prod_name','categories.id as cat_id','categories.name as cat_name','product_warehouses.stock','product_warehouses.condition as pw_condition')->paginate(10);

                return view('warehouse.product.index')->with(compact('products'));
    }

	public function create()
	{
        $products = DB::table('products')->select('products.id','products.name')
            ->whereNotIn('products.id',function($query){
                $value = session()->get('warehouse_id');
                $query->select('product_warehouses.product_id')
                    ->from('product_warehouses')->where('product_warehouses.warehouse_id','=',$value);
            })->get();
   
		return view('warehouse.product.create')->with(compact('products'));
  }
  
  public function store(ProductStorepRequest $request)
  {   
      $value                 = session()->get('warehouse_id');
      $product               = new ProductWarehouse();
      $product->product_id   = $request->get('product_id');
      $product->warehouse_id = $value;
      $product->stock        = $request->get('stock');
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

    public function show($id)
    {
    $value = session()->get('warehouse_id');
    
    $product=DB::table('products')
            ->join('product_warehouses','products.id','=','product_warehouses.product_id')
            ->join('categories','products.category_id','=','categories.id')
            ->join('units','products.unit_id','=','units.id')
            ->where('products.id','=',$id)
            ->where('product_warehouses.warehouse_id','=',$value)
            ->select('categories.name as cat_name','products.name as prod_name','units.name as unit_name','product_warehouses.stock','products.description as prod_des','products.picture as picture')
            ->first();
   
    return view('warehouse.product.show')->with(compact('product'));
    }

    public function edit($id)
    {
        $value      = session()->get('warehouse_id');
        $categories = Category::where('condition',1)->get();
        $units      = Unit::where('condition',1)->get();
        $product    = DB::table('products')
                ->join('product_warehouses','products.id','=','product_warehouses.product_id')
                ->join('categories','products.category_id','=','categories.id')
                ->join('units','products.unit_id','=','units.id')
                ->where('products.id','=',$id)
                ->where('product_warehouses.warehouse_id','=',$value)
                ->select('categories.id as cat_id','categories.name as cat_name','products.id','products.name as prod_name','units.id as unit_id','units.name as unit_name','product_warehouses.stock','products.description as prod_des','products.picture as picture')
                ->first();
       
        return view('warehouse.product.edit')->with(compact('product','categories','units'));
    }

    public function update(ProductUpdateRequest $request,ProductWarehouseUpdateRequest $request1, $id)
    {  
        try{
            DB::beginTransaction();
            $product              = Product::find($id);
            $product->category_id = $request->get('category_id');
            $product->name        = $request->get('name');
            $product->unit_id     = $request->get('unit_id');
            $product->description = $request->get('description');
            $image=$product->picture;
            
            if ($request->hasFile('picture')) {
                Storage::disk('products')->delete($image);
                $extension = $request->file('picture')->getClientOriginalExtension();
                $file_name = $id . '.' . $extension;
                Image:: make($request->file('picture'))
                ->resize(350,350)
                ->save('img/products/' . $file_name);
                $product->picture = $file_name;
            }

            $ucm          = auth()->user();
            $product->ucm = $ucm->id;
            $product->save();
            
            $value                    = session()->get('warehouse_id');
            $product_warehouse=ProductWarehouse::where('product_id',$id)->where('warehouse_id',$value)->first();
            $product_warehouse->stock = $request1->get('stock');
            $ucm                      = auth()->user();
            $product_warehouse->ucm   = $ucm->id;
            $product_warehouse->save();
            DB:: commit();
        } catch(Exception $e){
            DB::rollback();
        }

        return redirect()->route('product.index')->with('notification','Producto modificado exitosamente.');
    }

    public function delete($id){
        $value         = session()->get('warehouse_id');
        $pw            = ProductWarehouse::where('product_id',$id)->where('warehouse_id',$value)->first();
        $pw->condition = 0;
        $pw->save();

		return redirect()->route('product.index')->with('notification','El producto se dio de baja correctamente.');
    }
    
    public function restore($id){
		$value         = session()->get('warehouse_id');
        $pw            = ProductWarehouse::where('product_id',$id)->where('warehouse_id',$value)->first();
        $pw->condition = 1;
        $pw->save();

		return redirect()->route('product.index')->with('notification','El bus se habilitó correctamente.');
    }
    
    public function search()
    {
        if(request()->isMethod('POST')){
            $search= request('search');
            if($search){
                request()->session()->put('search',$search);
                request()->session()->save();
            } else{
                request()->session()->forget('search');
            }
        }

        return redirect('/productos');
    }

    public function clearSearch()
    {
        request()->session()->forget('search');

        return back();
    }
}
