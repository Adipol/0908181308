@extends('layouts.template') 
@section('content')

<section class="categorias">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Inicio</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Almacenes</li>
		</ol>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
						Almacenes
					</h3>
					<div class="card-body">
						<a href="{{ route('warehouse.create') }}" class="btn btn-primary card-title">Nuevo Almacén</a>
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
										<th>Nombre</th>
										<th>Ubicación</th>
										<th>Fecha de creación</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($warehouses as $warehouse)
									<tr id="tr_{{$warehouse->id}}">
										<th scope="row">
											<a href="{{ route('warehouse.edit', $warehouse->id) }}" title="Modificar almacén" class="btn  btn-sm btn-warning">
												<i class="fas fa-edit"></i>
											</a>
											@if ($warehouse->condition)
												<a href="{{ route('warehouse.delete', $warehouse->id) }}" class="btn btn-danger btn-sm"
													data-tr="tr_{{ $warehouse->id }}"				
													data-toggle="confirmation"
													data-btn-ok-label="Si, estoy seguro" data-btn-ok-icon="fa fa-remove"
													data-btn-ok-class="btn btn-sm btn-danger"
													data-btn-cancel-label="Cancelar"
													data-btn-cancel-icon="fa fa-chevron-circle-left"
													data-btn-cancel-class="btn btn-sm btn-primary"
													data-title="Desactivar el registro?"
													data-placement="left" data-singleton="true"><i class="fas fa-trash"></i>
												</a>
											@else
												<a href="{{ route('warehouse.restore', $warehouse->id) }}" class="btn btn-dark btn-sm"
												data-tr="tr_{{ $warehouse->id }}"				
												data-toggle="confirmation"
												data-btn-ok-label="Si, estoy seguro" data-btn-ok-icon="fa fa-remove"
												data-btn-ok-class="btn btn-sm btn-danger"
												data-btn-cancel-label="Cancelar"
												data-btn-cancel-icon="fa fa-chevron-circle-left"
												data-btn-cancel-class="btn btn-sm btn-primary"
												data-title="Activar el registro?"
												data-placement="left" data-singleton="true"><i class="fas fa-undo"></i>
												</a>
											@endif
										</th>
										<td>{{ $warehouse->name }}</td>
										<td>{{ $warehouse->ubication }}</td>
										<td>{{ $warehouse->created_at->format('d/m/Y') }}</td>
										<td>
											@if ($warehouse->condition===1)
											<span class="badge badge-success">Activo</span>
											@else
											<span class="badge badge-danger">Desactivado</span>
											@endif
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
							{{ $warehouses->links() }}
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