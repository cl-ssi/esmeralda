
<ul class="nav nav-tabs mb-3">
    @can('Admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-user"></i> Usuarios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.last-access') }}">
            <i class="fas fa-list-alt"></i> Últimos Accesos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.permissions.index') }}">
            <i class="fas fa-chalkboard-teacher"></i> Permisos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.lab') }}">
            <i class="fas fa-vial"></i> Laboratorios</a>
    </li>
    @endcan
    @canany(['Admin','SuspectCase: origin'])
    <li class="nav-item">
        <a class="nav-link" href="{{ route('lab.sample_origins.index') }}">
            <i class="fas fa-house-damage"></i> Origenes muestra</a>
    </li>
    @endcanany
    @can('Admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.ventilators.edit') }}">
            <i class="fas fa-fan"></i> Ventiladores</a>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.statu') }}">
            <i class="fas fa-exchange-alt"></i> Estados</a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.EventType') }}">
            <i class="fas fa-clipboard-list"></i> Tipos de eventos</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.request_type') }}">
            <i class="fas fa-clipboard-list"></i> Tipos de solicitudes</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.sample_types.index') }}">
            <i class="fas fa-dna"></i> Tipos de muestras</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.exam_types.index') }}">
            <i class="fas fa-medkit"></i> Tipos de examenes</a>
    </li>    

    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.sample_procedures.index') }}">
            <i class="fas fa-microscope"></i> Prestación</a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('parameters.establishment') }}">
            <i class="fas fa-store"></i> Establecimientos</a>
    </li>
    @endcan
</ul>

