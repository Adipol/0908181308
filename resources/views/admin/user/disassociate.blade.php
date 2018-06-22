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
                
                <div class="card mt-5">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Almacenes Asociados</h3>
                    <form method="post" action="{{ route('user.updateDisassociate', $user->id) }}">
                        @method('PUT')
                        {{csrf_field()}}
                    <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="detalles">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Almacén</th>
                                                    <th>Acceso</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($warehouses as $key=>$warehouse)
                                                    <tr>
                                                        <td><input type="hidden" name="warehouse[]" value="{{ $warehouse->id }}">{{ $key+1 }}</td>
                                                        <td>{{ $warehouse->name }}</td>
                                                        <td>
                                                            <select class="custom-select" name="condition[]">
                                                                <option value="0" @if($warehouse->condition=='0')selected
                                                                @endif>No</option>
                                                                <option value="1" @if($warehouse->condition=='1')selected
                                                                @endif>Sí</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No existe registros</td>
                                                    </tr>
                                                @endforelse
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
</section>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();
            $.ajax({
                url: ele.href,
                type: 'GET',
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
@endsection
