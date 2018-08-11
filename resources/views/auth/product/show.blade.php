@extends('layouts.template') 
@section('content')

<section class="category-show">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('access.index') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('productList.index') }}">Productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Vizualizar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Producto</h3>
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Nombre</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{ $product->prod_name }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Categoría</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="category" value="{{ $product->cat_name }}" disabled>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Medida</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="unit" value="{{ $product->unit_name }}" disabled>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Stock</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="stock" value="{{ $product->stock }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Descripción</label>
                                    <div class="col-md-8">
                                        <textarea name="description" cols="5" class="form-control" rows="5" value="" disabled>{{ $product->prod_des }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 col-xl-5 d-flex justify-content-center align-items-center">
                            <div class="card ">
                                @if($product->picture!="")
                                <img class="card-img-bottom img-thumbnail" src="{{ asset('img/products/'.$product->picture) }}" alt="Card image cap">
                                @else
                                <img class="card-img-bottom img-thumbnail" src="{{ asset('img/products/noImagen.png'.$product->picture) }}" alt="Imagen no disponible">
                                @endif
                            </div>
                        </div>
                    </div>    
                    <div class="card-footer">
                        <a href="{{ route('productList.index') }}" type="button" class="btn btn-secondary">Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection