@extends('layouts.template') 
@section('content')

<section class="categorias">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Seguimiento</li>
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
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Fecha de solicitud</th>
                                        <th>Solicitante</th>
                                        <th>Almacén</th>
                                        <th>Solicitud</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($requests as $request)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('trequest.show',$request->id) }}" title="Ver solicitud" class="btn  btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('request_pdf',$request->id) }}" title="Ver solicitud" class="btn  btn-sm btn-success">
                                            <i class="fas fa-eye"></i>
                                            </a>
                                        </th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->created_at )->format('d/m/Y') }}</td>  
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->w_name }}</td>
                                        <td>
                                            @if ($request->status=='APPROVED')
                                            APROBADO
                                            @else
                                                @if ($request->status=='DELIVERED')
                                                ENTREGADO                 
                                                @endif   
                                            @endif
                                        </td>
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