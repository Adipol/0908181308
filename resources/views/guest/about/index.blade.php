@extends('layouts.template') 
@section('content')
<section class="about">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('access.index') }}">Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Acerca de...</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <h3 class="card-header font-weight-bold text-primary bg-secondary text-white-50">
                        Acerca de..
                    </h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><img src="/images/logo/sipro.png" alt=""></td>
                                        <td>
                                            <h4 class="card-title">SIPRO</h4>
                                            <p class="card-text">
                                                Sistema de solicitud de productos.
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection