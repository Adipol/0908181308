@extends('layouts.template') 
@section('content')

<section class="category-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('access.index') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('category.index') }}">Categorías</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Nueva</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50"> Categoría</h3>
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
                    <form method="post" action="{{ route('category.store') }}">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre" value="{{ old('name') }}" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Descripción</label>
                                    <div class="col-sm-8">
                                    <textarea name="description" cols="30" class="form-control" rows="5" placeholder="Ingrese la descripción">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                                <a href="{{ route('category.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection