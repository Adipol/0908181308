@extends('layouts.template') 
@section('content')

<section class="entry-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('access.index') }}">Inicio</a>
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
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Ingreso</h3>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 offset-sm-6 col-form-label">Fecha</label>
                            <div class="col-sm-3">
                              <input type="text" name="date" class="form-control" value="{{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $entry->created_at )->format('d/m/Y')}}" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Encargado</label>
                            <div class="col-sm-3">
                                <input type="text" name="responsable" class="form-control" value="{{ $entry->name }}" disabled="disabled">
                            </div>      
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Almacén</label>
                            <div class="col-sm-3">
                                <input type="text" name="warehouse" class="form-control" value="{{ $entry->wa_name }}" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="detalles">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Categoría</th>
                                                <th>Cantidad</th>
                                                <th>Medida</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($details as $key=>$detail)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $detail->name }}</td>
                                                    <td>{{ $detail->c_name }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>{{ $detail->unit_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('entry.index') }}" type="button" class="btn btn-secondary">Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


