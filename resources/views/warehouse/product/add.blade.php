@extends('layouts.template') 
@section('content')

<section class="category-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('product.index') }}">Productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Registrar Producto</h3>
                    <div>
                        @if (count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <form method="post" action="{{ route('product.storep') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Categoria</label>
                                    <div class="col-md-8">
                                        <select class="custom-select" name="category_id" required>
                                            <option disabled selected hidden>Seleccione categoria</option>
                                            @foreach($categories as $category )
                                            <option {{ (int) old( 'category_id')===$category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Nombre</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre" value="{{ old('name')}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Unidad</label>
                                    <div class="col-md-8">
                                        <select class="custom-select" name="unit_id" required>
                                            <option disabled selected hidden>Seleccione unidad</option>
                                            @foreach($units as $unit )
                                            <option {{ (int) old( 'unit_id')===$unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-form-label">Cantidad</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="stock" placeholder="Ingrese la cantidad" min="0" value="{{ old('stock')}}" required>
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
                                        <textarea name="description" cols="5" class="form-control" rows="5" placeholder="Ingrese la descripcion">{{ old('description') }}</textarea>
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