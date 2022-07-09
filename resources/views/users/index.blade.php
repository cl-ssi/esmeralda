@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Listado de usuarios</h3>

<form method="get" class="form-horizontal" action="{{ route('users.index') }}">

    <div class="form-row">
        @can('Admin')
        <div class="col-12 col-md-2 mb-3">
            <label for="" class="sr-only"></label>
            <a class="btn btn-primary" href="{{ route('users.create') }}">
                Crear usuario
            </a>
        </div>
        @endcan
        <div class="col-12 col-md-3 mb-3">
            <label for="" class="sr-only"></label>
            <input class="form-control" type="text" name="search" value="{{ old('search') }}" placeholder="Nombre y/o apellido">
        </div>

        <div class="col-12 col-md-3 mb-3">
            <label for="" class="sr-only"></label>
            <select name="searchByEstab" id="" class="form-control">
                <option value="all" {{ old('searchByEstab') == 'all' ? 'selected' : '' }}>Todos los establecimientos</option>
                <option value="none" {{ old('searchByEstab') == 'none' ? 'selected' : '' }}>Sin establecimiento</option>
                @foreach($establishments as $id => $estab)
                <option value="{{ $id }}" {{ old('searchByEstab') == $id ? 'selected' : '' }}>{{ $estab }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-2 mb-3">
            <label for="" class="sr-only"></label>
            <select name="acceded" id="" class="form-control">
                <option></option>
                <option value="yes" {{ old('acceded') == 'yes' ? 'selected' : '' }}>Han accedido</option>
                <option value="no" {{ old('acceded') == 'no' ? 'selected' : '' }}>No han accedido</option>
            </select>
        </div>

        <div class="col-12 col-md-1 mb-3">
            <label for="" class="sr-only"></label>
            <button type="submit" class="btn btn-outline-primary btn-block">Buscar</button>
        </div>
    </div>

</form>


<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Perm.</th>
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
                <td> 
                    {!! $user->can('SuspectCase: admission') ? '<i class="fas fa-vial" title="Admission"></i>':'' !!}
                    {!! $user->can('SuspectCase: list') ? '<i class="fas fa-eye" title="SuspectCase List"></i>':'' !!}
                    {!! ($user->can('SanitaryResidence: user') OR $user->can('SanitaryResidence: view')) ? '<i class="fas fa-hotel" title="Residencia"></i>':'' !!}
                    {!! $user->can('SuspectCase: tecnologo') ? '<i class="fas fa-diagnoses" title="Tecnólogo"></i>':'' !!}
                    {!! $user->can('SuspectCase: tecnologo edit') ? '<i class="text-danger fas fa-diagnoses" title="Tecnólgo Editar"></i>':'' !!}
                    {!! $user->can('SuspectCase: delete') ? '<i class="text-danger fas fa-trash" title="SuspectCase Delete"></i>':'' !!}
                    {!! $user->can('Admin') ? '<i class="text-danger fas fa-chess-king" title="Admin"></i>':'' !!}
                </td>
                <td nowrap>
                    {!! $user->can('Redirection: https://esmeralda.saludtarapaca.org/') ? '<i class="text-success fas fa-check" title="NeoSalud"></i>':'' !!} 
                    <a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a> 
                    {!! !$user->active ? '<i class="fas fa-user-alt-slash"></i>':'' !!}
                </td>
                <td nowrap>{{ optional($user->establishment)->alias }}</td>
                <td>{{ $user->function }}</td>
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
