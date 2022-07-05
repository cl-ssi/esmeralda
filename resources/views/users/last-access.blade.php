@extends('layouts.app')

@section('title', 'Últimos Accesos')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Últimos Accesos</h3>

<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>Usuario</th>
                <th>Establecimiento</th>
                <th>Función</th>
                <th class="text-center">Fecha y hora</th>
                <th class="text-center">App Name</th>
                <th class="text-center">IP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logSessions as $logSession)
            <tr>
                <td class="text-center">
                    {{ $logSession->id }}
                </td>
                <td>
                    <a href="{{ route('users.edit', $logSession->user) }}">
                        {{ $logSession->user->name }}
                    </a>
                    @if(!$logSession->user->active)
                    <i class="fas fa-user-slash"></i>
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
                <td>
                    {{ $logSession->app_name }}
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