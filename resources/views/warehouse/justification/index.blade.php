@extends('layouts.template') 
@section('content')

<section class="categorias">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Reporte</li>
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
                        <div class="container">
                            <form class="form-inline d-flex justify-content-end" method="POST" action="{{ route('justification.search') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <select class="custom-select form-control mb-2 mr-sm-2" name="justification_id" value="">
                                        <option disabled selected hidden>Seleccione justificación</option>
                                        <option value="">Todos</option>
                                        @foreach($justifications as $justification )
                                        <option {{ (int) old( 'justification_id') === $justification->id || (int) session('justification_id') === $justification->id ? 'selected' : '' }} value="{{ $justification->id }}">{{ $justification->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>

                                <div class="form-group">
                                    <input type="date" class="form-control mb-2 mr-sm-2" name="from" placeholder="Fecha de inicio" max="{{ session('to') }}" value="{{ session('from') }}" required="required">
                                    <input type="date" class="form-control mb-2 mr-sm-2" name="to" placeholder="Fecha final" min="{{ session('from') }}" value="{{ session('to') }}" required="required">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary" title="Buscar"><i class="fas fa-search"></i></button>
                                    <a href="{{ route('justification.clear_search') }}" class="btn btn-sm btn-outline-dark" title="Limpiar"><i class="fas fa-eraser"></i></a>
                                </div>
                            </form>
                        </div>
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
                                            <a href="{{ route('justification.show',$request->id) }}" title="Ver solicitud" class="btn  btn-sm btn-info">
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

