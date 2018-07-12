@extends('layouts.template') 
@section('content')

<section class="entry-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('access.index') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('tdeliver.index') }}">Seguimiento</a>
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
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
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
                                            @foreach ($products as $key=>$product)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $product->p_name }}</td>
                                                    <td>{{ $product->c_name }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ $product->unit_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
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
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Observación</label>
                                <div class="col-sm-9" id="">
                                    <textarea name="description_j" cols="5" class="form-control" rows="5" placeholder="Ingrese el motivo" disabled="disabled">{{ $sol->description_j }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#voucher">
                                            Comprobante
                                    </button> 
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                            <a href="{{ route('tdeliver.index') }}" type="button" class="btn btn-secondary">Atrás</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
   
<div class="modal fade" id="voucher" tabindex="-1" role="dialog" aria-labelledby="voucherLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="voucherLabel">Comprobante</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <img class="card-img-bottom img-thumbnail" src="{{ asset('img/delivered/'.$sol->voucher) }}" alt="Comprobante">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
</section>
@endsection


