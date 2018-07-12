<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li>
            <a href="{{ route('access.index') }}">
                Menú
            </a>
        </li>
        <li>
            <a href="#sm_expand_1" data-toggle="collapse">
                <i class="fas fa-warehouse"></i> Almacén
            </a>
            <ul id="sm_expand_1" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('unity.index') }}" class="d-flex justify-content-between">Medición<i class="fas fa-angle-right"></i></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#sm_expand_5" data-toggle="collapse">
                <i class="fas fa-universal-access"></i> Acceso
            </a>
            <ul id="sm_expand_5" class="list-unstyled collapse">
                <li>
                    <a href="{{ route('warehouse.index') }}" class="d-flex justify-content-between">Almacenes<i class="fas fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('justification.index') }}" class="d-flex justify-content-between">Justificaciones<i class="fas fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}" class="d-flex justify-content-between">Usuarios<i class="fas fa-angle-right"></i></a>
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
            <a href="{{ route('about.index') }}">
                <i class="fas fa-info-circle"></i> Acerca de...
            </a>
        </li>
    </ul>
</div>