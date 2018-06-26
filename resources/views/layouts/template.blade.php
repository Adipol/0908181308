<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fa.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootadmin.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/me.css') }}">

    <title>BootAdmin</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="#">BootAdmin</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ route('access.index') }}" class="nav-link"><i class="fas fa-warehouse"></i> {{ 
            session('warehouse_name') }}</a></li>
            @include('partials.navigation.logged')
        </ul>
    </div>
</nav>

<div class="d-flex">
        @include('partials.navigation.' . \App\User::navigation())
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