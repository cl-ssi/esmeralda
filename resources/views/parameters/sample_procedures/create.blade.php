@extends('layouts.app')

@section('title', 'Crear Procedimiento')

@section('content')
@include('parameters.nav')

<h3 class="mb-3">Crear Procedimiento</h3>

<form method="POST" class="form-horizontal" action="{{ route('parameters.sample_procedures.store') }}">
    @csrf
    @method('POST')
    <div class="form-row">
        <fieldset class="form-group col-6 col-md-4">
            <label for="for_name">Nombre del procedimiento</label>
            <input type="text" class="form-control" name="name" id="for_name" required placeholder="ej: Panel de virus respiratorios" autocomplete="off">
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
        <small class="form-text text-muted">El Procedimiento debe tener mínimo un examen, posteriormente se pueden añadir más examenes</small><br><br><br><br><br>
    </div>

    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="for_pdf_all_exam">examenes en un PDF (sin separar)</label>
                <input type="checkbox" name="pdf_all_exam" id="for_pdf_all_exam" value="1">
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Guardar</button>

    <a class="btn btn-outline-secondary" href="{{ route('parameters.sample_procedures.index') }}">Cancelar</a>

</form>
@endsection

@section('custom_js')

@endsection