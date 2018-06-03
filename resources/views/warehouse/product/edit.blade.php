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
            <li class="breadcrumb-item active" aria-current="page">Modificar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Modificar Producto</h3>
                    <form method="post" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        {{csrf_field()}}
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Categoria</label>
                                    <div class="col-md-8">
                                        <select class="custom-select" name="category_id" required>
                                                <option disabled selected hidden>Seleccione categoria</option>
                                                @foreach($categories as $category )
                                                <option {{ (int) old('category_id') === $category->id || $product->cat_id === $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Nombre</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="{{ $product->prod_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="" class="col-md-4 col-form-label">Unidad</label>
                                        <div class="col-md-8">
                                            <select class="custom-select" name="unit_id" required>
                                                <option disabled selected hidden>Seleccione unidad</option>
                                                @foreach($units as $unit )
                                                <option {{ (int) old( 'unit_id') === $unit->id || $product->unit_id === $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>                                
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Cantidad</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Imagen</label>
                                    <div class="col-md-8">
                                        <div class="custom-file" style="es: Elegir;">
                                                <input type="file" class="custom-file-input" id="customFileLang" name="picture" lang="es">
                                            <label class="custom-file-label" for="customFileLang">Seleccione imagen</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Descripcion</label>
                                    <div class="col-md-8">
                                        <textarea name="description" cols="5" class="form-control" rows="5" value="">{{ $product->prod_des }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 mt-3 col-md-5 d-flex justify-content-center align-items-center">
                            <div class="card ">
                                @if($product->picture!="")
                                <img class="card-img-bottom img-thumbnail" src="{{ asset('img/products/'.$product->picture) }}" alt="Producto">
                                @else
                                <img class="card-img-bottom img-thumbnail" src="{{ asset('img/products/noImagen.png'.$product->picture) }}" alt="Imagen no disponible">
                                @endif
                            </div>
                        </div>
                    </div>    
                    <div class="card-footer">
                        <a href="{{ route('product.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>          
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection