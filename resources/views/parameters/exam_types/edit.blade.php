@extends('layouts.app')

@section('title', 'Editar Tipo de Examen')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Editar Tipo de Examen</h3>
<form method="POST" class="form-horizontal" action="{{ route('parameters.exam_types.update', $examType) }}">
    @csrf
    @method('PUT')
    <div class="form-row">
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off" value="{{ $examType->name }}">
        </fieldset>
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_values">Valores</label>
            <input type="text" class="form-control" name="values" id="for_values" required placeholder="" autocomplete="off" value="{{ implode(', ', json_decode($examType->values)) }}">
            <small class="form-text text-muted">Ingresar valores separados por coma (ej. No Informado, Positivo, Negativo)</small>
        </fieldset>
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_unit">Unidad (opcional)</label>
            <input type="text" class="form-control" name="unit" id="for_unit" placeholder="" autocomplete="off" value="{{ $examType->unit }}">
        </fieldset>
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_reference">Rango de Referencia (opcional)</label>
            <input type="text" class="form-control" name="reference_range" id="for_reference" placeholder="" autocomplete="off" value="{{ $examType->reference_range }}">
        </fieldset>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>

    <a class="btn btn-outline-secondary" href="{{ route('parameters.exam_types.index') }}">Cancelar</a>

</form>
@endsection
@section('custom_js')

@endsection