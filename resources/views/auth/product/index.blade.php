@extends('layouts.template')
@section('content')
<section class="accesos">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                        Productos
                    </h3>
                    <div class="card-body">
                     
                        <form class="form-inline d-flex justify-content-end" method="POST" action="{{ route('productList.search') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control mb-2 mr-sm-2" name="searchAuth" placeholder="Ingrese el producto" value="{{ session('searchAuth') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary" title="Buscar"><i class="fas fa-search"></i></button>
                                <a href="{{ route('productList.clear_search') }}" class="btn btn-sm btn-outline-dark" title="Limpiar"><i class="fas fa-eraser"></i></a>
                            </div>
                        </form>                   
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Producto</th>
                                        <th>Categoría</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td> 
                                                <a href="{{ route('productList.show',$product->id) }}" title="Ver el producto" class="btn  btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->c_name }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                @if ($product->condition==1)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-danger">Desactivado</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No existe registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">
                            {{ $products->links() }}
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 