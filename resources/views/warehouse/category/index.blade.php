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
					<button type="button" class="btn btn-primary card-title">Registrar</button>
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
@endsection