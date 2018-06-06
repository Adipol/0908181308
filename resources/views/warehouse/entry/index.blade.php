@extends('layouts.template') @section('content')

<section class="categorias">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Ingreso de productos</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                        Ingreso de productos
                    </h3>
                    <div class="card-body">
                        <a href="{{ route('entry.create') }}" class="btn btn-primary card-title">Nuevo</a>
                        <div class="alert-custom">
                            @if (session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification')}}
                            </div>
                            @endif @if (count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Encargado</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($incomes as $entry)
                                    <tr>
                                        <th scope="row">
                                            <a href="#" title="Eliminar entrada" class="btn  btn-sm btn-warning">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="#" title="Ver la entrada" class="btn  btn-sm btn-success">
                                                    <i class="fas fa-eye"></i>
                                            </a>
                                        </th>
                                        <td>{{ $entry->responsable }}</td>
                                        <td>{{ $entry->inc_created}}</td>
                                        <td>
                                            @if ($entry->inc_condition==1)
                                            <span class="badge badge-success">Activo</span>
                                             @else
                                            <span class="badge badge-danger">Desactivado</span> @endif
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
                            {{-- {{ $entry->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection @push('scripts')
{{-- <script type="text/javascript">
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
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {},
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
    });
</script> --}}

@endpush