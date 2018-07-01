<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li>
            <a href="#">
                Menú
            </a>
        </li>
        <li>
            <a href="#sm_expand_1" data-toggle="collapse">
                <i class="fas fa-warehouse"></i> Almacen
            </a>
            <ul id="sm_expand_1" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('category.index') }}" class="d-flex justify-content-between">Categorias<i class="fas fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="{{route('product.index')}}" class="d-flex justify-content-between">Productos<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_2" data-toggle="collapse">
                <i class="fas fa-angle-double-right"></i> Entrada de productos
            </a>
            <ul id="sm_expand_2" class="list-unstyled collapse">
                <li>
                    <a href="{{route('entry.index')}}" class="d-flex justify-content-between">Ingresos<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_3" data-toggle="collapse">
                <i class="fas fa-shopping-cart"></i> Salidas
            </a>
            <ul id="sm_expand_3" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('deliver.index') }}" class="d-flex justify-content-between">Entregar Solicitudes<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_4" data-toggle="collapse">
                <i class="fas fa-history"></i> Seguimiento
            </a>
            <ul id="sm_expand_4" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('tdeliver.index') }}" class="d-flex justify-content-between">Entregar Solicitudes<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_6" data-toggle="collapse">
                <i class="far fa-file-alt"></i> Reportes
            </a>
            <ul id="sm_expand_6" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('chart.index') }}" class="d-flex justify-content-between">Gráficos<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-info-circle"></i> Acerca de...</a>
        </li>
    </ul>
</div>