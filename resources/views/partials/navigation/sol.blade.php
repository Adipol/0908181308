<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li>
            <a href="#">
                Menu Item
            </a>
        </li>
        <li>
            <a href="#sm_expand_1" data-toggle="collapse">
                <i class="fas fa-warehouse"></i> Almacén
            </a>
            <ul id="sm_expand_1" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('access.index') }}" class="d-flex justify-content-between">Acceso<i class="fas fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('productList.index') }}" class="d-flex justify-content-between">Productos<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_3" data-toggle="collapse">
                <i class="fas fa-shopping-cart"></i> Salidas
            </a>
            <ul id="sm_expand_3" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('request.index') }}" class="d-flex justify-content-between">Solicitudes<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_4" data-toggle="collapse">
                <i class="fas fa-history"></i> Seguimiento
            </a>
            <ul id="sm_expand_4" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('trequest.index') }}" class="d-flex justify-content-between">Solicitudes<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-info-circle"></i> Acerca de...</a>
        </li>
    </ul>
</div>