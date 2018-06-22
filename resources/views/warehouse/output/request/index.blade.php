@extends('layouts.template') 
@section('content')

<section class="categorias">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Solicitud de productos</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                        Solicitud de Productos
                    </h3>
                    <div class="card-body">
                        <a href="{{ route('request.create') }}" class="btn btn-primary card-title">Nueva Solicitud</a>
                        <div class="alert-custom">
                            @if (session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification')}}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error')}}
                            </div>
                            @endif 
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Fecha de solicitud</th>
                                        <th>Solicitante</th>
                                        <th>Almacén</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($requests as $request)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('request.show',$request->id) }}" title="Ver solicitud" class="btn  btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                            </a>
                                        @if($request->condition)
                                            <a href="{{ route('request.delete',$request->id) }}" class="btn btn-danger btn-sm"
                                                data-tr="tr_{{ $request->id }}"		
                                                data-toggle="confirmation"
                                                data-btn-ok-label="Si, estoy seguro" data-btn-ok-icon="fa fa-remove"
                                                data-btn-ok-class="btn btn-sm btn-danger"
                                                data-btn-cancel-label="Cancelar"
                                                data-btn-cancel-icon="fa fa-chevron-circle-left"
                                                data-btn-cancel-class="btn btn-sm btn-primary"
                                                data-title="Esta seguro de anular la solicitud?"
                                                data-placement="left" data-singleton="true"><i class="fas fa-trash"></i>
                                            </a>
                                        @endif
                                        </th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->created_at )->format('d/m/Y') }}</td>
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->w_name }}</td>
                                        <td>
                                            @if ($request->condition==1)
                                            <span class="badge badge-success">Activo</span>
                                             @else
                                            <span class="badge badge-danger">Anulado</span> @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">No existe registros</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 
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