@extends('layouts.app')

@section('title', 'Editar Muestra')

@section('content')
<div class="row">
    <div class="col-4">
        <h3 class="mb-3">Editar muestra Nº{{$sample->id }}</h1>
    </div>

    @php
    $patient = $sample->patient;
    $suspectCase = $sample;
    @endphp
    @include('patients.show',$patient)




    <form method="POST" action="{{ route('lab.samples.update', $sample) }}" enctype="multipart/form-data">
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

        <hr>

        @foreach($sample->sampleResults as $examResult)
        <div class="form-row">
            <fieldset class="form-group col-6 col-md-3 alert-warning">
                <label for="for_result_ifd">Resultado {{$examResult->exam_name}}</label>
                <select name="result_ifd" id="for_result_ifd" class="form-control">
                    @foreach(json_decode($examResult->exam->values) as $value)
                    <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
        @endforeach

        <hr>

        <button type="submit" class="btn btn-primary">Actualizar Muestra</button>
    </form>

    @endsection

    @section('custom_js')

    @endsection