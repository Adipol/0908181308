@extends('layouts.template') 
@section('content')

<section class="rol-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{ route('user.index') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Nuevo usuario</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">Nuevo Usuario</h3>
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
                    <form method="post" action="{{ route('user.store') }}">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre" value="{{ old('name') }}" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Correo electrónico</label>
                                <div class="col-sm-8">
                                    <input type="mail" name="email" class="form-control" placeholder="Ingrese el correo electronico" value="{{ old('email') }}" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-4 col-form-label">Contraseña</label>
                                <div class="col-sm-8">
                                    <input type="text" name="password" class="form-control" placeholder="Ingrese la contraseña" value="{{ old('password') }}" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label">Rol</label>
                                <div class="col-md-8">
                                    <select class="custom-select" name="rol_id" required>
                                            <option disabled selected hidden>Seleccione rol</option>
                                            @foreach($rols as $rol)
                                            <option {{ (int) old('rol_id') === $rol->id ? 'selected' : '' }} value="{{ $rol->id }}">{{ $rol->name }}</option>
                                            @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                                <a href="{{ route('user.index') }}" type="button" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection