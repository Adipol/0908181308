@extends('layouts.template') 
@section('content')

<section class="category-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('justification.index') }}">Justificaciones</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Modificar justificación</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Modificar Justificación</h3>
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
                    <form method="post" action="{{ route('justification.update', $justification->id) }}">
                        @method('PUT')
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nombre</label>
                                <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Ingrese la justificación" value="{{ $justification->name }}" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                                <a href="{{ route('justification.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection