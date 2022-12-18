@extends('layouts.app')

{{-- Se establece el título de la página --}}
@section('title', 'Listado de Tipo de Examenes')

{{-- Se define la sección "content" de la plantilla --}}
@section('content')
{{-- Se incluye el menú de parámetros --}}
@include('parameters.nav')

{{-- Se muestra un título en la página --}}
<h3 class="mb-3">Listado de Tipos de Examenes</h3>

{{-- Se muestra un botón que lleva a la vista de creación de tipos de exámenes --}}
<a class="btn btn-primary mb-3" href="{{ route('parameters.exam_types.create') }}">Crear nuevo Tipo de Examen</a>

{{-- Se muestra una tabla con el listado de tipos de exámenes --}}
<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Nombre del examen</th>
            <th>Valores</th>
            <th>Unidad</th>
            <th>Rango de Referencia</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        {{-- Se recorren los tipos de exámenes y se muestra cada uno en una fila de la tabla --}}
        @foreach($exam_types as $exam_type)
        <tr>
            <td>{{ $exam_type->name }}</td>
            {{-- Aquí se muestra el valor del atributo "values" --}}
            <td>
                @foreach(json_decode($exam_type->values) as $value)
                {{ $value }}<br>
                @endforeach
            </td>
            {{-- Se muestra el valor del atributo "unit" --}}
            <td>{{ $exam_type->unit }}</td>
            {{-- Se muestra el valor del atributo "reference_range" --}}
            <td>{{ $exam_type->reference_range }}</td>
            <td>
                {{-- Se muestra un botón que lleva a la vista de edición de cada tipo de examen --}}
                <a class="btn btn-secondary btn-sm" href="{{ route('parameters.exam_types.edit', $exam_type) }}">
                    Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>    
</table>
@endsection