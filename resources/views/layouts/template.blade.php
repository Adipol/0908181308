<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fa.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootadmin.min.css')}}">
    <title>BootAdmin</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="#">BootAdmin</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Doe</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>

</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <li><a href="#"><i class="fa fa-fw fa-link"></i> Menu Item</a></li>
            <li>
                <a href="#sm_expand_1" data-toggle="collapse">
                    <i class=""></i> Almacen
                </a>
                <ul id="sm_expand_1" class="list-unstyled collapse">
                    <li><a href="{{route('category.index')}}" class="{{ Helper::navigation_selected('category.index') }}">Categorias</a></li>
                    <li><a href="{{route('product.index')}}">Productos</a></li>
                </ul>
            </li>
            <li>
                <a href="#sm_expand_2" data-toggle="collapse">
                    <i class="fas fa-coins"></i> Entrada de productos
                </a>
                <ul id="sm_expand_2" class="list-unstyled collapse">
                    <li><a href="{{route('entry.index')}}">Ingresos</a></li>
                </ul>
            </li>
            <li>
                <a href="#sm_expand_3" data-toggle="collapse">
                    <i class="fa fa-fw fa-link"></i>Salidas
                </a>
                <ul id="sm_expand_3" class="list-unstyled collapse">
                    <li><a href="{{ route('request.index') }}">Solicitudes</a></li>
                    <li><a href="{{ route('approve.index') }}">Aprobar Solicitudes</a></li>
                    <li><a href="{{ route('deliver.index') }}">Entregar Solicitudes</a></li>
                </ul>
            </li>
            <li>
                <a href="#sm_expand_4" data-toggle="collapse">
                    <i class="fa fa-fw fa-link"></i>Seguimiento
                </a>
                <ul id="sm_expand_4" class="list-unstyled collapse">
                    <li><a href="{{ route('trequest.index') }}">Solicitudes</a></li>
                    <li><a href="{{ route('tapprove.index') }}">Aprobar Solicitudes</a></li>
                    <li><a href="{{ route('tdeliver.index') }}">Entregar Solicitudes</a></li>
                </ul>
            </li>
            <li>
                <a href="#sm_expand_4" data-toggle="collapse">
                    <i class="fa fa-fw fa-link"></i>Acceso
                </a>
                <ul id="sm_expand_4" class="list-unstyled collapse">
                    <li><a href="#">Almacenes</a></li>
                    <li><a href="#"><i class="far fa-users"></i> Usuarios</a></li>
                    <li><a href="#">Roles</a></li>
                </ul>
            </li>
            <li>
                <a href="#sm_expand_5" data-toggle="collapse">
                    <i class="fa fa-fw fa-link"></i>Reportes
                </a>
                <ul id="sm_expand_5" class="list-unstyled collapse">
                    <li><a href="#">Reporte de Salidas</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-fw fa-link"></i> Acerca de...</a></li>
        </ul>
    </div>
	
	<div class="content d-flex flex-column">
			@yield('content')
	</div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/bootadmin.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.js')}}"></script>
<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
@stack('scripts')
</body>
</html>