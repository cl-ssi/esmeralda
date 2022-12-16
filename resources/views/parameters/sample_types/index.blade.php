@extends('layouts.app')

@section('title', 'Listado de Laboratorios')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Listado de Tipos de Muestras</h3>

<a class="btn btn-primary mb-3" href="{{ route('parameters.sample_types.create') }}">Crear nuevo Tipo de Muestra</a>

<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>Nombre de la muestra</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sample_types as $sample_type)
    <td>{{ $sample_type->name }}</td>
    <td>
            <a href="{{ route('parameters.sample_types.edit', $sample_type) }}" class="btn btn-secondary float-left"><i class="fas fa-edit"></i></a>
            </td>
    @endforeach
    </tbody>
</table>


@endsection

@section('custom_js')

@endsection