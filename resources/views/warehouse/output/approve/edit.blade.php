@extends('layouts.template') 
@section('content')

<section class="entry-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('approve.index') }}">Solicitud de productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Solicitud</h3>
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
                    <form method="post" action="{{ route('approve.update',$sol->id) }}">
                        @method('PUT')
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped" id="detalles">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad solicitada</th>
                                                <th>Cantidad aprobada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key=>$product)
                                                <tr>
                                                    <td><input type="hidden" name="product[]" value="{{ $product->id }}">{{ $key+1 }}</td>
                                                    <td>{{ $product->p_name }}</td>
                                                    <td><input type="hidden" name="quantity[]" value="{{ $product->quantity }}">{{ $product->quantity }}</td>
                                                    <td><input type="number" id="real" name="real[]" min="0" max="{{ $product->quantity }}" value="{{ $product->quantity }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('approve.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary" id="bt_add">Guardar</button>
                        @if($sol->condition)
                        <a href="{{ route('approve.delete',$sol->id) }}" class="btn btn-danger"
                            data-tr="tr_{{ $sol->id }}"		
                            data-toggle="confirmation"
                            data-btn-ok-label="Si, estoy seguro" data-btn-ok-icon="fa fa-remove"
                            data-btn-ok-class="btn btn-sm btn-danger"
                            data-btn-cancel-label="Cancelar"
                            data-btn-cancel-icon="fa fa-chevron-circle-left"
                            data-btn-cancel-class="btn btn-sm btn-primary"
                            data-title="Esta seguro de anular la solicitud?"
                            data-placement="right" data-singleton="true"
                            >Anular solicitud
                        </a>
                    @endif
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        /* $('#bt_add').click(function(){
            sum();
        }); */

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });
/*         real=$('#real').val();
        function sum (){
            var acum = 0;
            for (var i = 0; i<real.length; i++){
            acum = acum + i;
            }
            if (acum===0) {
                
                return swal({
                                type: 'error',
                                title: 'se le sugiere anular la solicitud!',
                                });
            }
        } */

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
    });
</script>
@endpush
