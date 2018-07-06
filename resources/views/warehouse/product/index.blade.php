@extends('layouts.template') 
@section('content')

<section class="productos">
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
                        <div class="container d-flex justify-content-between">
                            <a href="{{ route('product.create') }}" class="btn btn-primary card-title">Adicionar Producto</a>

                            <form class="form-inline align-self-center" method="POST" action="{{ route('product.search') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" class="form-control mb-2 mr-sm-2" name="search" placeholder="Ingrese el producto"  value="{{ session('search') }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary" title="Buscar"><i class="fas fa-search"></i></button>
                                        <a href="{{ route('product.clear_search') }}" class="btn btn-sm btn-outline-dark" title="Limpiar"><i class="fas fa-eraser"></i></a>
                                    </div>
                                    
                                </form>
                        </div>
                        
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
                                        <th>Categoría</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('product.edit',$product->prod_id) }}" title="Modificar el producto" class="btn  btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('product.show',$product->prod_id) }}" title="Ver el producto" class="btn  btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                            </a>
                                            @if($product->pw_condition)
                                            <a href="{{ route('product.delete',$product->prod_id) }}" class="btn btn-danger btn-sm"
                                                data-tr="tr_{{$product->prod_id}}"							
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
                                            <a href="{{ route('product.restore',$product->prod_id) }}" title="Activar producto" class="btn  btn-sm btn-info">
                                            <i class="fas fa-undo"></i>
                                            </a>
                                            @endif
                                        </th>
                                        <td>{{ $product->prod_name }}</td>
                                        <td>{{ $product->cat_name}}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if ($product->pw_condition==1)
                                            <span class="badge badge-success">Activo</span> @else
                                            <span class="badge badge-danger">Desactivado</span> @endif
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
                            {{ $products->links() }}
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