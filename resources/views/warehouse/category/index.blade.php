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
					<table class="table table-hover">
						<thead class="thead-light">
							<tr>
								<th>Opciones</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Fecha de elaboracion</th>
								<th>Fecha de modificacion</th>	
								<th>Estado</th>
							</tr>
						</thead>
						<tbody>
						@forelse ($categories as $category)
						<tr>
							<th scope="row">
							<a href="{{ route('category.create') }}" title="Dar de baja" class="btn  btn-sm btn-danger"><i class="f	ont"> dar de baja</i></a>
							</th>
							<td>{{ $category->name }}</td>
							<td>{{ $category->description }}</td>
							<td>{{ $category->created_at }}</td>
							<td>{{ $category->updated_at }}</td>
							<td>{{ $category->condition }}</td>
						</tr>
						@empty
							<tr><td colspan="6">No existe registros</td></tr>
						@endforelse	
						</tbody>
					</table>		
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
			<form action="">
				<div class="modal-body">
					<div class="form-group row">
						<label for="" class="col-md-3 col-form-label" required>Nombre</label>
						<div class="col-md-9">
							<input type="text" name="name"
							id="" class="form-control" placeholder="Ingrese el nombre" aria-describedby="helpId">
						</div>					
					</div>
					<div class="form-group row">
						<label for="" class="col-md-3 col-form-label">Descripcion</label>
						<div class="col-md-9">
							<textarea class="form-control" name="description" id="" rows="3" placeholder="Ingrese la descripcion "></textarea>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection