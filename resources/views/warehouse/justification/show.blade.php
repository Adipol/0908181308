@extends('layouts.template') 
@section('content')

<section class="entry-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('access.index') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('tapprove.index') }}">Seguimiento</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Solicitud</h3>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 offset-sm-6 col-form-label">Fecha</label>
                            <div class="col-sm-3">
                                <input type="text" name="text" class="form-control" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sol->created_at )->format('d/m/Y') }}" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Solicitante</label>
                            <div class="col-sm-3">
                                <input type="text" name="applicant" class="form-control" value="{{ $sol->u_name }}" disabled="disabled">
                            </div>      
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Almacén</label>
                            <div class="col-sm-3">
                                <input type="text" name="warehouse" class="form-control" value="{{ $sol->w_name }}" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Justificación</label>
                            <div class="col-sm-9">
                                @foreach($justifications as $justification)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" disabled checked>
                                    <label class="custom-control-label" for="customCheck1">{{ $justification->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Detalle</label>
                            <div class="col-sm-9" id="">
                                <textarea name="description_j" cols="5" class="form-control" rows="5" placeholder="Ingrese el motivo" disabled="disabled">{{ $sol->description_j }}</textarea>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="detalles">
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
                                            @forelse ($products as $key=>$product)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $product->p_name }}</td>
                                                    <td>{{ $product->c_name }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ $product->unit_name }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">Los productos fueron denegados</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                        @if ($sol->status == 'APPROVED')
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Solicitud</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="justification" class="form-control" value="APROBADO" disabled="disabled">
                                        </div>
                                        @else
                                            @if ($sol->status == 'DELIVERED')
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Solicitud</label>
                                            <div class="col-sm-3">
                                            <input type="text" name="justification" class="form-control" value="ENTREGADO" disabled="disabled">
                                                </div>
                                            @endif
                                        @endif
                                </div>
                            </div>
                        </div>        
                        </div>    
                    <div class="card-footer">
                        <a href="{{ route('justification.index') }}" type="button" class="btn btn-secondary">Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


