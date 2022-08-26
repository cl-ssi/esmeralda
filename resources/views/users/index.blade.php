@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Listado de usuarios 
    @can('Admin')
    <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
        Crear nuevo
    </a>
    @endcan
</h3>

<form method="get" class="form-horizontal" action="{{ route('users.index') }}">

    <div class="form-row">
        <div class="col-12 col-md-2 mb-3">
            <label for="">Nombre y/o apellido</label>
            <input class="form-control" type="text" name="search" value="{{ old('search') }}" placeholder="Nombre y/o apellido" autocomplete="off">
        </div>
       
        <div class="col-12 col-md-3 mb-3">
            <label for="">Establecimientos</label>
            <select name="searchByEstab" id="" class="form-control">
                <option value="all" {{ old('searchByEstab') == 'all' ? 'selected' : '' }}>Todos</option>
                <option value="none" {{ old('searchByEstab') == 'none' ? 'selected' : '' }}>Sin establecimiento</option>
                @foreach($establishments as $id => $estab)
                <option value="{{ $id }}" {{ old('searchByEstab') == $id ? 'selected' : '' }}>{{ $estab }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-2 mb-3">
            <label for="">Acceso</label>
            <select name="acceded" id="" class="form-control">
                <option value="">Todos</option>
                <option value="yes" {{ old('acceded') == 'yes' ? 'selected' : '' }}>Han accedido</option>
                <option value="no" {{ old('acceded') == 'no' ? 'selected' : '' }}>No han accedido</option>
            </select>
        </div>

        <div class="col-12 col-md-2 mb-3">
            <label for="">Permisos</label>
            <select name="searchByPermission" id="" class="form-control">
                <option value="any" {{ old('searchByPermission') == 'any' ? 'selected' : '' }}></option>
                @foreach($permissions as $permission)
                <option value="{{ $permission }}" {{ old('searchByPermission') == $permission ? 'selected' : '' }}>{{ $permission }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-2 mb-3">
            <label for="">Estado</label>
            <select name="active" id="" class="form-control">
                <option value="yes" {{ old('active') == 'yes' ? 'selected' : '' }}>Activos</option>
                <option value="no" {{ old('active') == 'no' ? 'selected' : '' }}>Inactivos</option>
                <option value="">Todos</option>
            </select>
        </div>

        <div class="col-12 col-md-1 mb-3">
            <label for="">&nbsp;</label>
            <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
        </div>
    </div>

</form>


<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Permisos</th>
                <th>Nombre</th>
                <th>Establecimiento</th>
                <th>Función</th>
                <th>Acceso</th>
                <th>Ultimo login</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td nowrap> 
                    {!! $user->can('SuspectCase: admission') ? '<i class="text-success fas fa-vial" title="Admission"></i>':'' !!}
                    {!! $user->can('SuspectCase: own') ? '<i class="text-success fas fa-eye" title="SuspectCase own (ver sus propios exámenes)"></i>':'' !!}
                    {!! $user->can('SuspectCase: list') ? '<i class="fas fa-eye" title="SuspectCase List (Ver todos los exámenes)"></i>':'' !!}
                    {!! $user->can('Patient: list') ? '<i class="fas fa-users" title="Patient: list (Listar todos los pacientes)"></i>':'' !!}
                    {!! ($user->can('SanitaryResidence: user') OR $user->can('SanitaryResidence: view')) ? '<i class="fas fa-hotel" title="Residencia"></i>':'' !!}
                    {!! $user->can('SuspectCase: tecnologo') ? '<i class="fas fa-diagnoses" title="Tecnólogo"></i>':'' !!}
                    {!! $user->can('SuspectCase: tecnologo edit') ? '<i class="text-danger fas fa-diagnoses" title="Tecnólgo Editar"></i>':'' !!}
                    {!! ($user->can('SuspectCase: delete') OR $user->can('SuspectCase: file delete')) ? '<i class="text-danger fas fa-trash" title="SuspectCase Delete o File Delete"></i>':'' !!}
                    {!! $user->can('Patient: delete') ? '<i class="text-danger fas fa-user-slash" title="Patient Delete"></i>':'' !!}
                    {!! ($user->can('Admin') OR $user->can('Developer')) ? '<i class="text-danger fas fa-chess-king" title="Admin o Developer"></i>':'' !!}
                </td>
                <td nowrap>
                    {!! $user->can('Redirection: https://esmeralda.saludtarapaca.org/') ? '<i class="fas fa-share" title="Redirecciona a nuevo Esmeralda"></i>':'' !!} 
                    <a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a> 
                    {!! !$user->active ? '<i class="fas fa-ban" title="Eliminado"></i>':'' !!}
                </td>
                <td class="small">{{ optional($user->establishment)->alias }}</td>
                <td nowrap>{{ $user->function }}</td>
                <td class="small">{{ $user->establishments->count() }} estab</td>
                <td class="small" nowrap>{{ optional($user->lastLogin)->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $users->links() }}

@endsection

@section('custom_js')

@endsection
