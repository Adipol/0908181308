@extends('layouts.template') 
@section('content')

<section class="category-show">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('product.index') }}">Productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Vizualizar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Registrar Producto</h3>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Categoria</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category" value="{{ $product->cat_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{ $product->prod_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Medida</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="unit" value="{{ $product->unit_name }}">
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Cantidad</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Descripcion</label>
                                    <div class="col-md-9">
                                        <textarea name="description" cols="5" class="form-control" rows="5" value="">{{ $product->prod_des }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <div class="card mr-3">
                                <div class="card-body text-center">{{ $product->prod_name }}</div>
                                <img class="card-img-bottom img-thumbnail" src="/images/pathToYourImage.png" alt="Card image cap">
                            </div>
                        </div>
                    </div>    
                    <div class="card-footer">
                        <a href="{{ route('product.index') }}" type="button" class="btn btn-secondary">Atras</a>             
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection