@extends('layouts.app')

@section('title', 'Crear nueva Muestra')

@section('content')
<h1>Crear {{$sampleProcedure->name }}</h1>

<form method="post" action="{{ route('lab.samples.store') }}">
    @csrf

    <input type="hidden" id="procedure_id" name="procedure_id" value="{{ $sampleProcedure->id }}">
    <input type="hidden" id="procedure_name" name="procedure_name" value="{{ $sampleProcedure->name }}">


    <div class="form-row">

        <fieldset class="form-group col-5 col-md-3">
            <label for="for_sample_at">Fecha Muestra *</label>
            <input type="datetime-local" class="form-control" id="for_sample_at" name="sample_at" value="{{ date('Y-m-d\TH:i:s') }}" required min="{{ date('Y-m-d\TH:i:s', strtotime("-2 week")) }}" max="{{ date('Y-m-d\TH:i:s') }}">
        </fieldset>

        <fieldset class="form-group col-7 col-md-3">
            <label for="for_sample_type">Tipo de Muestra *</label>
            <select name="sample_type" id="for_sample_type" class="form-control" required>
                <option value="" {{(old('sample_type') == '') ? 'selected' : '' }}>Seleccionar tipo de muestra</option>
                @foreach($sample_types as $sample_type)
                <option value="{{ $sample_type->name }}" {{(old('sample_type') == $sample_type->name) ? 'selected' : '' }}>{{ $sample_type->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_establishment_id">Establecimiento *</label>
            <select name="establishment_id" id="for_establishment_id" class="form-control" required>
                <option value="">Seleccionar Establecimiento</option>
                @foreach($establishmentsusers as $establishmentsusers)
                <option value="{{ $establishmentsusers->establishment->id }}" {{(old('establishment_id') == $establishmentsusers->establishment->id) ? 'selected' : '' }}>{{ $establishmentsusers->establishment->alias }}</option>
                @endforeach
            </select>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Crear Muestra</button>
</form>
@endsection

@section('custom_js')

@endsection