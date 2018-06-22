@extends('layouts.template')
@section('content')
<section class="accesos">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Acceso</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                        Acceso
                    </h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Almacén</th>
                                        <th>Ubicación</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($associates as $key=>$associated)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $associated->name }}</td>
                                            <td>{{ $associated->ubication }}</td>
                                            <td>
                                                @if ($associated->condition==1)
                                                <span class="badge badge-success">Activo</span> @else
                                                <span class="badge badge-danger">Desactivado</span> @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Sin registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 