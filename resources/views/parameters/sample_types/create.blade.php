@extends('layouts.app')

@section('title', 'Crear Tipo de Muestra')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Crear Tipo de Muestra</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.sample_types.store') }}">
    @csrf
    @method('POST')
    <div class="form-row">
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="" autocomplete="off">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

    <a class="btn btn-outline-secondary" href="{{ route('parameters.sample_types.index') }}">Cancelar</a>

</form>

@endsection

@section('custom_js')

@endsection