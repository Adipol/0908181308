@extends('layouts.template')
@section('contenido')

<section class="categorias">
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Inicio</a></li>
		<li class="breadcrumb-item active" aria-current="page">Categorias</li>
	</ol>
</nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Categorias
				</div>
				<div class="card-body">
					<button type="button" class="btn btn-primary card-title" data-toggle="modal" data-target="#modalCreate">
						Adicionar
					</button>
					<div class="alert alert-success" style="display:none"></div>

					<div class="table-responsive">
							<table class="table table-hover">
								<thead class="thead-light">
									<tr>
										<th>Opciones</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Fecha de creacion</th>	
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
								@forelse ($categories as $category)
								<tr>
									<th scope="row">
									<a href="" title="Dar de baja" class="btn  btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
									<a href="" title="Modificar" class="btn  btn-sm btn-warning"><i class="fas fa-edit    "></i></a>
									</th>
									<td>{{ $category->name }}</td>
									<td>{{ $category->description }}</td>
									<td>{{ $category->created_at }}</td>
									<td>
										@if ($category->condition===1)
											<span class="badge badge-success">Activo</span>
										@else
											<span class="badge badge-danger">Desactivado</span>
										@endif
									</td>
								</tr>
								@empty
									<tr><td colspan="6">No existe registros</td></tr>
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
  
  <!-- Modal -->
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModal3Label">Registrar Categoria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
			</div>
			<form method="post" action="{{url('categoria/store')}}">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="alert alert-danger" style="display:none"></div>
					<div class="form-group row">
						<label for="" class="col-md-3 col-form-label">Nombre</label>
						<div class="col-md-9">
							<input type="text" name="name"
							id="name" class="form-control" placeholder="Ingrese el nombre">
						</div>					
					</div>
					<div class="form-group row">
						<label for="" class="col-md-3 col-form-label">Descripcion</label>
						<div class="col-md-9">
							<textarea class="form-control" name="description" id="description" rows="3" placeholder="Ingrese la descripcion"></textarea>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="ajaxSubmit">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
      <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                  headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/categoria/store') }}",
                  method: 'post',
                  data: {
					name       : jQuery('#name').val(),
					description: jQuery('#description').val(),
                  },
                  success: function(result){
                  	if(result.errors)
                  	{
                  		jQuery('.alert-danger').html('');
                  		jQuery.each(result.errors, function(key, value){
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<li>'+value+'</li>');
                  		});
                  	}
                  	else
                  	{ 
                  		jQuery('.alert-danger').hide();
						$('#modalCreate').modal('hide');
						//window.location = '{{ url("/categorias") }}';	
						jQuery('.alert-success').show();
                    	jQuery('.alert-success').html(result.success);
                  	}
                  }});
               });
            });
      </script>
@endpush