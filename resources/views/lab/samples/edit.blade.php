@extends('layouts.app')

@section('title', 'Editar Muestra')

@section('content')
<div class="row">
    <div class="col-4">
        <h3 class="mb-3">Editar muestra Nº{{$sample->id }}</h1>
    </div>
</div>


@php
$patient = $sample->patient;
$suspectCase = $sample;
@endphp
@include('patients.show',$patient)




<form method="POST" action="{{ route('lab.samples.update', $sample) }}">
    @csrf
    @method('PUT')
    <div class="form-row">

        <fieldset class="form-group col-5 col-md-3">
            <label for="for_sample_at">Fecha Muestra *</label>
            <input type="datetime-local" class="form-control" id="for_sample_at" name="sample_at" value="{{ date('Y-m-d\TH:i:s') }}" required min="{{ date('Y-m-d\TH:i:s', strtotime("-2 week")) }}" max="{{ date('Y-m-d\TH:i:s') }}" value="{{ $sample->sample_at }}">
        </fieldset>

        <fieldset class="form-group col-7 col-md-3">
            <label for="for_sample_type">Tipo de Muestra *</label>
            <select name="sample_type" id="for_sample_type" class="form-control" required>
                <option value="" {{(old('sample_type') == '') ? 'selected' : '' }}>Seleccionar tipo de muestra</option>
                @foreach($sample_types as $sample_type)
                <option value="{{ $sample_type->name }}" {{($sample->sample_type== $sample_type->name) ? 'selected' : '' }}>{{ $sample_type->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_establishment_id">Establecimiento *</label>
            <select name="establishment_id" id="for_establishment_id" class="form-control" required>
                <option value=""></option>
                @foreach($establishments as $establishment)
                <option value="{{ $establishment->id }}" {{ ($establishment->id == $sample->establishment_id)?'selected':'' }}>{{ $establishment->alias }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_origin">Estab. Detalle (Opcional)</label>
            <select name="origin" id="for_origin" class="form-control">
                <option value=""></option>
                @foreach($sampleOrigins as $sampleOrigin)
                <option value="{{ $sampleOrigin->name }}" {{ ($suspectCase->origin == $sampleOrigin->name)?'selected':'' }}>
                    {{ $sampleOrigin->alias }}
                </option>
                @endforeach
            </select>
        </fieldset>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Datos Muestra</button>
</form>
<hr>
<form method="POST" action="{{ route('lab.samples.update_file', $sample) }}">
    @csrf
    @method('PUT')
    <div class="form-row">
        <fieldset class="form-group col-6 col-md-6 alert-danger">
            <label for="for_result_at">Fecha Resultado {{$sample->procedure_name}}</label>
            <input type="datetime-local" class="form-control" id="for_result_at" name="result_at" value="{{ isset($sample->result_at)? $sample->result_at->format('Y-m-d\TH:i:s'):'' }}" max="{{ date('Y-m-d\T23:59:59') }}" required>
        </fieldset>
        <fieldset class="form-group col-6 col-md-6 alert-danger">
            <label for="for_pcr_sars_cov_2">Archivo</label>
            <div class="custom-file">
                <input type="file" name="forfile" class="custom-file-input" id="forfile" lang="es" accept="application/pdf" required>
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            </div>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Subir Resultado de {{$sample->procedure_name}}</button>
</form>

<hr>

@foreach($sample->sampleResults as $sampleResult)
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Resultado {{$sampleResult->exam_name}}</h5>
        <form method="POST" action="{{ route('lab.samples.update_result', $sampleResult) }}">

            @csrf
            @method('PUT')
            <div class="form-group">

                <select name="result" id="for_result" class="form-control">


                    @foreach(json_decode($sampleResult->exam->values) as $value)
                    <option value="{{$value}}" {{ (trim($sampleResult->result) == trim($value))?'selected':'' }}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar resultado</button>
        </form>
    </div>
</div>
@endforeach








<hr>




@endsection

@section('custom_js')

@endsection