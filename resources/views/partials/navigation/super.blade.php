<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li>
            <a href="#">
                Menu Item
            </a>
        </li>
        <li>
            <a href="#sm_expand_3" data-toggle="collapse">
                <i class="fas fa-shopping-cart"></i> Salidas
            </a>
            <ul id="sm_expand_3" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('approve.index') }}" class="d-flex justify-content-between">Aprobar Solicitudes<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_4" data-toggle="collapse">
                <i class="fas fa-history"></i> Seguimiento
            </a>
            <ul id="sm_expand_4" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('tapprove.index') }}" class="d-flex justify-content-between">Solicitudes<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_5" data-toggle="collapse">
                <i class="far fa-file-alt"></i> Reportes
            </a>
            <ul id="sm_expand_5" class="list-unstyled collapse">
                <li>
                    <a href="#" class="d-flex justify-content-between">Reporte de Salidas<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-info-circle"></i> Acerca de...</a>
        </li>
    </ul>
</div>