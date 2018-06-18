@extends('layouts.template') 
@section('content')

<section class="rol-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('user.index') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Asociar almacen</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Usuario</h3>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Correo electrónico</label>
                                <div class="col-sm-8">
                                    <input type="mail" name="email" class="form-control" value="{{ $user->email }}" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Rol</label>
                                <div class="col-sm-8">
                                    <input type="mail"name="rol"class="form-control"value="{{ $user->r_name }}"readonly="readonly">
                                </div>
                            </div>
                        </div> 
                </div>

                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Asociar Almacen</h3>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="warehouse" class="col-sm-2 col-form-label">Almacen</label>
                            <div class="col-sm-7"> 
                                <select class="custom-select" name="warehouse_id" id="warehouse_id" required="required">
                                @foreach($warehouses as $warehouse )
                                <option {{ (int) old( 'warehouse_id')===$warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-primary" href="#" role="button" id="bt_add">Agregar</button>
                            </div>
                        </div>
                        <form method="post" action="{{ route('user.updateAssociate', $user->id) }}">
                            @method('PUT')
                            {{csrf_field()}}
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="detalles">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Opciones</th>
                                                        <th>Almacen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="card-footer">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{ route('user.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>

        </div>
    </div>
</section>
@push('scripts')
<script>
$(document).ready(function () {
    $('#bt_add').click(function () {
        agregar();
    });
});

var cont=0;
var compare=0;
var vecalmacen=[];

function agregar(){
    idalmacen=$('#warehouse_id').val();
    almacen=$('#warehouse_id option:selected').text();

    for (var i = 0; i < vecalmacen.length; i++) {
        if (vecalmacen[i] === idalmacen) {
            compare=1;
            return swal({
                    type: 'error',
                    title: 'Producto se encuentra agregado!',
                    });
        } else {
            compare=0;
        }
    }

    if (compare === 0) {
        if(idalmacen != "" && idalmacen > 0){
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"><i class="far fa-trash-alt"></i></td><td><input type="hidden" name="warehouse[]" value="'+idalmacen+'" required="required">'+almacen+'</td></tr>';
            vecalmacen.push(idalmacen);
            cont++;
            limpiar();
            $('#detalles').append(fila);
        }else{
            swal({
                type: 'error',
                title: 'Revise los datos!',
                });
            } 
    }
}

function limpiar(){
    $('#pcantidad').val('');
}

function eliminar(index) {
    $('#fila'+index).remove();
    delete vecalmacen[index];
}
</script>
@endpush
@endsection
