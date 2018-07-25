@extends('layouts.app')

@section('content')

            <div class="login-wrap">

                 <form id="test-form" method="POST" action="{{ route('login') }}">
                    @csrf 
                     <div class="row">
                        <div class="col-12">
                            <h1 class="hide-fade delay-6">Acceso</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <input id="name" type="name" class="check-name {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus />
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                {{-- <span class="valid-icon"></span> --}}
                                <label for="name">Usuario</label>
                                {{-- <span class="bottom-border"></span> --}}
                            </div>
                            <div class="input-group">
                                <input id="password" type="password" class="check-password {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                {{-- <span class="valid-icon"></span> --}}
                                <label for="password">Contraseña</label>
                                {{-- <span class="bottom-border"></span> --}}
                            </div>
                            <div class="input-group">
                                    {{-- <label for="warehouse" class="col-md- col-form-label text-md-right">{{ __('Almacén') }}</label> --}}
                                    <div class="col-12">
                                       <select class="custom-select" id="event" name="warehouse_id" required="required">
                                           <option disabled selected hidden>Seleccione almacén</option>
                                           @foreach($warehouses as $warehouse )
                                           <option {{ (int) old( 'warehouse_id')===$warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                           @endforeach
                                       </select>
                                    </div>
                               </div>
                        </div>
                    </div>
                    <div class="row login-footer">
                        <div class="col-7">
                            {{-- <a href="#" class="btn">Ingreso</a> --}}
                            <button type="submit" class="btn">
                                Ingreso
                            </button>
                        </div>
                    </div>
                    <div class="row login-footer">
                        <div class="col-12 hide-fade delay-7">
                            <a class="forgot" href="{{ route('password.request') }}">Olvido contraseña?</a>
                        </div>
                    </div>
                 </form> 

             </div>





{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Acceso') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                             <label for="warehouse" class="col-md-4 col-form-label text-md-right">{{ __('Almacén') }}</label>
                             <div class="col-md-6">
                                <select class="custom-select" id="event" name="warehouse_id" required="required">
                                    <option disabled selected hidden>Seleccione almacén</option>
                                    @foreach($warehouses as $warehouse )
                                    <option {{ (int) old( 'warehouse_id')===$warehouse->id ? 'selected' : '' }} value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                             </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordar datos') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Olvido contraseña?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
