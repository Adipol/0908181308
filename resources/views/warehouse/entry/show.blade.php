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
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Visualizar Ingreso </h3>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 offset-sm-6 col-form-label">Fecha</label>
                            <div class="col-sm-3">
                              <input type="text" name="date" class="form-control" value="{{ $entry->created_at }}" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Encargado</label>
                            <div class="col-sm-3">
                                <input type="text" name="responsable" class="form-control" value="{{ $entry->name }}" disabled="disabled">
                            </div>      
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Almacen</label>
                            <div class="col-sm-3">
                                <input type="text" name="warehouse" class="form-control" value="{{ $entry->wa_name }}" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light border border-dark">
                        <div class="row mt-3">
                            <div class="col-sm-8 offset-sm-2">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="detalles">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($details as $key=>$detail)
                                                <tr>
                                                    <td style="padding-left:15px;">{{ $key+1 }}</td>
                                                    <td>{{ $detail->name }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('entry.index') }}" type="button" class="btn btn-secondary">Atras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


