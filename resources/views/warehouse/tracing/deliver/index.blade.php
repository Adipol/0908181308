@extends('layouts.template') 
@section('content')

<section class="categorias">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"> Entrega de productos</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                        Entrega de Productos
                    </h3>
                    <div class="card-body">
                        <div class="alert-custom">
                            @if (session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification')}}
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
                                        <th>Justificacion</th>
                                        <th>Solicitud</th>
                                        <th>Almacen</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($requests as $request)
                                    <tr>
                                        <th scope="row">
                                            @if ($request->voucher == '')
                                                <a href="{{ route('tdeliver.edit',$request->id) }}" title="Actualizar datos" class="btn  btn-sm btn-success">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                                 <a href="{{ route('tdeliver.show',$request->id) }}" title="Ver solicitud" class="btn  btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                        </th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $request->created_at )->formatLocalized('%A %d %B %Y') }}</td>  
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->j_name }}</td>
                                        <td>
                                            @if ($request->status=='APPROVED')
                                            APROBADO
                                            @else
                                                @if ($request->status=='DELIVERED')
                                                ENTREGADO               
                                                @endif   
                                            @endif
                                        </td>
                                        <td>{{ $request->w_name }}</td>
                                        <td>
                                            @if ($request->condition==1)
                                            <span class="badge badge-success">Ingresado</span>
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

