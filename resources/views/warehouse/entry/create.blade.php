@extends('layouts.template') 
@section('content')

<section class="entry-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('entry.index') }}">Ingreso de productos</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Registrar</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Registrar Ingreso </h3>
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
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 offset-sm-6 col-form-label">Fecha</label>
                            <div class="col-sm-3">
                              <input type="date" name="date" class="form-control" value="{{ old('date',date('Y-m-d'))}}" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Encargado</label>
                            <div class="col-sm-3">
                                <input type="text" name="responsable" class="form-control" value="{{ $ucm }}" disabled="disabled">
                            </div>      
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Almacen</label>
                            <div class="col-sm-3">
                                <input type="text" name="warehouse" class="form-control" value="{{ $warehouse }}" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light border border-dark">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Producto</label>
                            <div class="col-sm-3"> 
                                <select class="custom-select" name="product_id" id="product_id" required="required">
                                @foreach($products as $product )
                                <option {{ (int) old( 'product_id')===$product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="col-sm-3">
                                <input type="number"  name="stock" id="pcantidad" class="form-control" value="" min="0" required="required">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary" href="#" role="button" id="bt_add">Agregar</button>
                            </div>
                        </div>  
                        
                    <form method="post" action="{{ route('entry.store') }}">
                    {{csrf_field()}}
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="detalles">
                                        <thead class="thead-dark">
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
                    <div class="card-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('entry.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                    </div>
                </form>
                </div>
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
    var compare=0;
    var vecarticulo=[];

    function agregar() {
        idarticulo=$('#product_id').val();
        articulo=$('#product_id option:selected').text();
        cantidad=$('#pcantidad').val();
        
            for (var i = 0; i < vecarticulo.length; i++) {
                if (vecarticulo[i] === idarticulo) {
                    compare = 1;
                    return swal({
                                type: 'error',
                                title: 'Producto se encuentra agregado!',
                                });
                } else {
                    compare = 0;
                }
            }

        if(compare === 0)
        {
            if(idarticulo!="" && cantidad!="" && cantidad>0){
                var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"><i class="far fa-trash-alt"></i></td><td><input type="hidden" name="product[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" min="0" name="stock[]" value="'+cantidad+'" required="required"></td></tr>';

                vecarticulo.push(idarticulo);
                cont++;
                limpiar();
                $('#detalles').append(fila);
            }
            else{
                swal({
                        type: 'error',
                        title: 'No se pudo ingresar el producto!',
                        });
                } 
        } 
    }

    function limpiar(){
        $('#pcantidad').val('');
    }

    function eliminar(index) {
        $('#fila'+index).remove();
        delete vecarticulo[index];
    }

</script>
@endpush
@endsection


