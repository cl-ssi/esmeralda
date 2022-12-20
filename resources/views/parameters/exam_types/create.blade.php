@extends('layouts.app')

@section('title', 'Crear Tipo de Examen')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Crear Tipo de Examen</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.exam_types.store') }}">
    @csrf
    @method('POST')
    <div class="form-row">
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off">
        </fieldset>
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_values">Valores</label>
            <input type="text" class="form-control" name="values" id="for_values" required placeholder="" autocomplete="off">
            <small class="form-text text-muted">Ingresar valores separados por coma, el primero siempre debe ser No Solicitado (ej. No Informado, Positivo, Negativo)</small>
        </fieldset>
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_unit">Unidad (opcional)</label>
            <input type="text" class="form-control" name="unit" id="for_unit" placeholder="" autocomplete="off">
        </fieldset>
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_reference">Rango de Referencia (opcional)</label>
            <input type="text" class="form-control" name="reference_range" id="for_reference" placeholder="" autocomplete="off">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

    <a class="btn btn-outline-secondary" href="{{ route('parameters.exam_types.index') }}">Cancelar</a>

</form>
@endsection

@section('custom_js')

@endsection