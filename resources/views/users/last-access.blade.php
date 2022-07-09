@extends('layouts.app')

@section('title', 'Últimos Accesos')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Últimos Accesos</h3>

<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Permisos</th>
                <th class="text-center">App Name</th>
                <th>Usuario</th>
                <th>Establecimiento</th>
                <th>Función</th>
                <th class="text-center">Fecha y hora</th>
                <th class="text-center">IP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logSessions as $logSession)
            <tr>
                <td nowrap> 
                    {!! $logSession->user->can('SuspectCase: admission') ? '<i class="text-success fas fa-vial" title="Admission"></i>':'' !!}
                    {!! $logSession->user->can('SuspectCase: own') ? '<i class="text-success fas fa-eye" title="SuspectCase own (ver sus propios exámenes)"></i>':'' !!}
                    {!! $logSession->user->can('SuspectCase: list') ? '<i class="fas fa-eye" title="SuspectCase List (Ver todos los exámenes)"></i>':'' !!}
                    {!! ($logSession->user->can('SanitaryResidence: user') OR $logSession->user->can('SanitaryResidence: view')) ? '<i class="fas fa-hotel" title="Residencia"></i>':'' !!}
                    {!! $logSession->user->can('SuspectCase: tecnologo') ? '<i class="fas fa-diagnoses" title="Tecnólogo"></i>':'' !!}
                    {!! $logSession->user->can('SuspectCase: tecnologo edit') ? '<i class="text-danger fas fa-diagnoses" title="Tecnólgo Editar"></i>':'' !!}
                    {!! ($logSession->user->can('SuspectCase: delete') OR $logSession->user->can('SuspectCase: file delete')) ? '<i class="text-danger fas fa-trash" title="SuspectCase Delete o File Delete"></i>':'' !!}
                    {!! $logSession->user->can('Patient: delete') ? '<i class="text-danger fas fa-user-slash" title="Patient Delete"></i>':'' !!}
                    {!! ($logSession->user->can('Admin') OR $logSession->user->can('Developer')) ? '<i class="text-danger fas fa-chess-king" title="Admin o Developer"></i>':'' !!}
                </td>
                <td nowrap>
                    @if( $logSession->user->can('Redirection: https://esmeralda.saludtarapaca.org/') )
                            <i class="fas fa-caret-right"></i>
                    @endif
                    {{ $logSession->app_name }}
                </td>
                <td>
                    <a href="{{ route('users.edit', $logSession->user) }}">
                        {{ $logSession->user->name }} 
                    </a>
                    @if(!$logSession->user->active)
                    <i class="fas fa-ban"></i>
                    @endif
                </td>
                <td>
                    {{ optional($logSession->user->establishment)->alias }}
                </td>
                <td>
                    {{ $logSession->user->function }}
                </td>
                <td class="text-center small" nowrap>
                    {{ $logSession->created_at }}
                </td>
                <td class="text-center small">
                    <span class="text-monospace">
                        {{ $logSession->ip }}
                    </span>
                </td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="6">
                    <em>No hay registros</em>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

{{ $logSessions->links() }}

@endsection