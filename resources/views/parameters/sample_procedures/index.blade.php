@extends('layouts.app')

@section('title', 'Listado de Laboratorios')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Listado de Prestación</h3>

<a class="btn btn-primary mb-3" href="{{ route('parameters.sample_procedures.create') }}">Crear nuevo Procedimiento</a>

<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Nombre de la prestación</th>
            <th>Examenes</th>
            <th>Agregar Examen</th>
            <th>Eliminar Examen</th>
    <tbody>
        @foreach($sampleProcedures as $sampleProcedure)
        <tr>
            <td>{{ $sampleProcedure->name }}</td>
            <td>
                @foreach($sampleProcedure->exams as $examn)
                {{ $examn->name}}<br>
                @endforeach
            </td>
            <td>
                <a href="{{ route('parameters.sample_procedures.edit', $sampleProcedure) }}" class="btn btn-primary btn-sm">Agregar Exámen a Procedimiento</a>

            </td>
            <td>
                <form action="{{ route('parameters.sample_procedures.destroy', $sampleProcedure) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar Procedimiento</button>
                </form>
            </td>

        </tr>
        @endforeach

    </tbody>
    </tr>
    </thead>
</table>


@endsection

@section('custom_js')

@endsection