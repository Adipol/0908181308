<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-link"></i> Menu Item</a>
        </li>
        <li>
            <a href="#sm_expand_1" data-toggle="collapse">
                <i class=""></i> Almacen
            </a>
            <ul id="sm_expand_1" class="list-unstyled collapse">
                <li>
                    <a href="{{route('category.index')}}" class="{{ Helper::navigation_selected('category.index') }}">Categorias</a>
                </li>
                <li>
                    <a href="{{route('product.index')}}">Productos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_2" data-toggle="collapse">
                <i class="fas fa-coins"></i> Entrada de productos
            </a>
            <ul id="sm_expand_2" class="list-unstyled collapse">
                <li>
                    <a href="{{route('entry.index')}}">Ingresos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_3" data-toggle="collapse">
                <i class="fa fa-fw fa-link"></i>Salidas
            </a>
            <ul id="sm_expand_3" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('request.index') }}">Solicitudes</a>
                </li>
                <li>
                    <a href="{{ route('approve.index') }}">Aprobar Solicitudes</a>
                </li>
                <li>
                    <a href="{{ route('deliver.index') }}">Entregar Solicitudes</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_4" data-toggle="collapse">
                <i class="fa fa-fw fa-link"></i>Seguimiento
            </a>
            <ul id="sm_expand_4" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('trequest.index') }}">Solicitudes</a>
                </li>
                <li>
                    <a href="{{ route('tapprove.index') }}">Aprobar Solicitudes</a>
                </li>
                <li>
                    <a href="{{ route('tdeliver.index') }}">Entregar Solicitudes</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_4" data-toggle="collapse">
                <i class="fa fa-fw fa-link"></i>Acceso
            </a>
            <ul id="sm_expand_4" class="list-unstyled collapse">
                <li>
                    <a href="#">Almacenes</a>
                </li>
                <li>
                    <a href="#">
                        <i class="far fa-users"></i> Usuarios</a>
                </li>
                <li>
                    <a href="#">Roles</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_5" data-toggle="collapse">
                <i class="fa fa-fw fa-link"></i>Reportes
            </a>
            <ul id="sm_expand_5" class="list-unstyled collapse">
                <li>
                    <a href="#">Reporte de Salidas</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-fw fa-link"></i> Acerca de...</a>
        </li>
    </ul>
</div>