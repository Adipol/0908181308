@extends('layouts.template') 
@section('content')

<section class="categorias">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Inicio</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Categorias</li>
		</ol>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
						Categorias
					</h3>
					<div class="card-body">
						<a href="{{ route('category.create') }}" class="btn btn-primary card-title">Nueva Categoria</a>
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
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Fecha de creacion</th>
										<th>Fecha de modificacion</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($categories as $category)
									<tr id="tr_{{$category->id}}">
										<th scope="row">
											<a href="{{ url('categorias',$category->id) }}" class="btn btn-danger btn-sm"
											data-tr="tr_{{$category->id}}"							
											data-toggle="confirmation"
											data-btn-ok-label="Si, estoy seguro" data-btn-ok-icon="fa fa-remove"
											data-btn-ok-class="btn btn-sm btn-danger"
											data-btn-cancel-label="Cancelar"
											data-btn-cancel-icon="fa fa-chevron-circle-left"
											data-btn-cancel-class="btn btn-sm btn-primary"
											data-title="Estas seguro de dar de baja el registro?"
											data-placement="left" data-singleton="true"><i class="fas fa-trash"></i>
											</a>
											<a href="{{ route('category.edit',$category->id) }}" title="Modificar" class="btn  btn-sm btn-warning">
												<i class="fas fa-edit"></i>
											</a>
										</th>
										<td>{{ $category->name }}</td>
										<td>{{ $category->description }}</td>
										<td>{{ $category->created_at }}</td>
										<td>{{ $category->updated_at }}</td>
										<td>
											@if ($category->condition===1)
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
							{{ $categories->links() }}
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
                type: 'DELETE',
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
