@extends('layouts.template') 
@section('content')

<section class="category-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('product.index') }}">Productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Registrar Producto</h3>
                    <div>
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
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                    <select class="custom-select" id="product_id" name="product_id" required>
                                        <option disabled selected hidden>Seleccione producto</option>
                                        @foreach($products as $product )
                                        <option {{ (int) old( 'product_id')===$product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary mt-3 mb-3" href="#" role="button" id="bt_add">Agregar Producto</button>
                            </div>
                        <form method="post" action="{{ route('product.store') }}">
                        {{csrf_field()}}
                        <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="detalles">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Opciones</th>
                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="{{ route('product.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
        });
    });
    var cont=0;
    
    function agregar() {
        idarticulo=$('#product_id').val();
        articulo=$('#product_id option:selected').text();
        cantidad=0;
        $('#bt_add').hide();
        if(idarticulo!="")
        {
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"><i class="far fa-trash-alt"></i></td><td><input type="hidden" name="idarticulo" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad" value="'+cantidad+'"></td></tr>';
            cont++;
            $('#detalles').append(fila);
        }
        else{
            alert("Error al ingresar el producto!")
        }

    }

    function eliminar(index) {
        $('#fila'+index).remove();
        $('#bt_add').show();
    }

</script>
@endpush
@endsection


