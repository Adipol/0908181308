@extends('layouts.template') 
@section('content')

<section class="categorias">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('access.index') }}">Inicio</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Categorías</li>
		</ol>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
						Categorías
					</h3>
					<div class="card-body">
						<div class="container">
                            <a href="{{ route('category.create') }}" class="btn btn-primary card-title">Nueva Categoría</a>
                            <form class="form-inline" method="POST" action="{{ route('category.search') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-2 mr-sm-2" name="search" placeholder="Ingrese la categoría"  value="{{ session('search_category') }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary" title="Buscar"><i class="fas fa-search"></i></button>
                                        <a href="{{ route('category.clear_search') }}" class="btn btn-sm btn-outline-dark" title="Limpiar"><i class="fas fa-eraser"></i></a>
                                    </div>
                                    
                                </form>
                        </div>
						<div class="alert-custom">
							@if (session('notification'))
							<div class="alert alert-success">
								{{ session('notification')}}
							</div>
							@endif 
							@if (count($errors)>0)
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
										<th>Descripción</th>
										<th>Fecha de creación</th>
										<th>Fecha de modificación</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									@forelse ($categories as $category)
									<tr id="tr_{{$category->id}}">
										<th scope="row">
											<a href="{{ route('category.edit',$category->id) }}" title="Modificar" class="btn  btn-sm btn-warning">
												<i class="fas fa-edit"></i>
											</a>
										</th>
										<td>{{ $category->name }}</td>
										<td>{{ $category->description }}</td>
										<td>{{ $category->created_at->format('d/m/Y') }}</td>
										<td>{{ $category->updated_at->format('d/m/Y') }}</td>
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
