<li class="nav-item dropdown">
	<a id="navbarDropdown"
		class="nav-link dropdown-toggle"
		href="#" role="button"
		data-toggle="dropdown"
		aria-haspopup="true"
		aria-expanded="false"
	>
		<i class="fas fa-user"></i> {{ auth()->user()->name }} <span class="caret"></span>
	</a>

	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<a class="dropdown-item" href="{{-- {{ route('profile.index') }} --}}"><i class="fas fa-user-md"></i> {{ __("Mi Perfil") }}</a>
		<a class="dropdown-item" href="{{ route('logout') }}"
			onclick="event.preventDefault();
			document.getElementById('logout-form').submit();"
		>
		<i class="fas fa-sign-out-alt"></i>	{{ __("Cerrar sesión") }}
		</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
	</div>
</li>