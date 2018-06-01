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
                    <form method="post" action="{{ route('product.storep') }}">
                    {{csrf_field()}}
                    <div class="car-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Categoria</label>
                            <div class="col-sm-8">
                                <select class="custom-select" name="category" required>
                                    <option disabled selected hidden>Seleccione almacen</option>
                                    @foreach($categories as $category )
                                    <option {{ (int) old( 'category')===$category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Nombre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Unidad</label>
                            <div class="col-sm-8">
                                <select class="custom-select" name="unit" required>
                                    <option disabled selected hidden>Seleccione unidad</option>
                                    @foreach($units as $unit )
                                    <option {{ (int) old( 'unit')===$unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Imagen</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control-file" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label font-weight-bold">Descripcion</label>
                            <div class="col-sm-8">
                                <textarea name="description" cols="5" class="form-control" rows="5" placeholder="Ingrese la descripcion">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('product.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary" >Guardar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
