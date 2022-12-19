@extends('layouts.app')

@section('title', 'Añadir Examen')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Añadir Examel al Procedimiento</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.sample_procedures.update', $sampleProcedure) }}">
    @csrf
    @method('PUT')
    <div class="form-row">
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_name">Nombre del procedimiento</label>
            <input type="text" class="form-control" name="name" id="for_name" value="{{ $sampleProcedure->name }}" readonly required placeholder="ej: Panel de virus respiratorios" autocomplete="off">
        </fieldset>

        <fieldset class="form-group col-7 col-md-3">
            <label for="for_sample_type">Examen*</label>
            <select name="exam_id" id="for_exam_id" class="form-control" required>
                <option value="" {{(old('exam_id') == '') ? 'selected' : '' }}>Seleccionar tipo de muestra</option>
                @foreach($examTypes as $examType)
                <option value="{{ $examType->id }}" {{(old('exam_id') == $examType->id) ? 'selected' : '' }}>{{ $examType->name }}</option>
                @endforeach
            </select>
        </fieldset>        
    </div>

    <button type="submit" class="btn btn-primary">Añadir Examen</button>

    <a class="btn btn-outline-secondary" href="{{ route('parameters.sample_procedures.index') }}">Cancelar</a>

</form>
@endsection

@section('custom_js')

@endsection