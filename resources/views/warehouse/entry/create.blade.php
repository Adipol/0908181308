@extends('layouts.template') 
@section('content')

<section class="entry-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('entry.index') }}">Ingreso de productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Registrar Ingreso </h3>
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
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 offset-sm-6 col-form-label">Fecha</label>
                            <div class="col-sm-4">
                              <input type="date" name="date" class="form-control" value="{{ old('date',date('Y-m-d'))}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Encargado</label>
                            <div class="col-sm-4">
                                <input type="date" name="date" class="form-control" value="{{ old('date',date('Y-m-d'))}}" disabled>
                            </div>      
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Almacen</label>
                            <div class="col-sm-4">
                                <input type="date" name="date" class="form-control" value="{{ old('date',date('Y-m-d'))}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light border border-dark">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Producto</label>
                            <div class="col-sm-4"> 
                                <select class="custom-select" name="product_id" id="product_id" required="required">
                                <option disabled selected hidden>Seleccione producto</option>
                                @foreach($products as $product )
                                <option {{ (int) old( 'product_id')===$product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="col-sm-4">
                                <input type="number" name="stock" class="form-control" value="" min="0" required="required">
                            </div>
                        </div>  
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary mt-3 mb-3" href="#" role="button" id="bt_add">Agregar Producto</button>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


