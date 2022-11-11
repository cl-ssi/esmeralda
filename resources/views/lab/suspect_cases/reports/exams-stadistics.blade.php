@extends('layouts.app')

@section('title', 'Listado de casos')

@section('content')

<h3 class="mb-3"><i class="fas fa-lungs-virus"></i>
    Estadisticas de exámenes por {{ $stadistics_by }}
</h3>

<form method="post" action="{{ route('lab.suspect_cases.reports.exams-stadistics-posts',$stadistics_by) }}">
	@method('POST')
	@csrf
	<div class="form-row">
		<div class="col">
			<label for="">Establecimiento</label>
			<select name="establishment_id" id="establishment_id" class="form-control">
				<option value="">Todos</option>
				@foreach($establishments as $id => $name)
				<option value="{{ $id }}" {{ old('establishment_id') == $id ? 'selected':'' }}>{{ $name }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-3">
			<label for="">Desde</label>
			<input type="date" name="from" class="form-control" value="{{ old('from') }}">
		</div>
		<div class="col-3">
			<label for="">Hasta</label>
			<input type="date" name="to" class="form-control" value="{{ old('to') }}">
		</div>
		<div class="col-1">
			<label for="">&nbsp;</label>
			<button class="btn btn-outline-primary form-control" name="btn_filter" value="true">Filtro</button>
		</div>
	</div>
</form>

<br>

@if(isset($counters))
<div class="table-responsive">
<table class="table table-sm table-bordered">
    <thead>
        <tr class="text-center">
            <th scope="col">Positivos</th>
            <th scope="col">Negativos</th>
            <th scope="col">Pendientes</th>
            <th scope="col">Rechazados</th>
            <th scope="col">Indeterminados</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <th class="text-danger">{{ $counters['positive'] }}</th>
            <td>{{ $counters['negative'] }}</td>
            <td>{{ $counters['pending'] }}</td>
            <td>{{ $counters['rejected'] }}</td>
            <td>{{ $counters['undetermined'] }}</td>
            <td>{{ $counters['total'] }}</td>
        </tr>
    </tbody>
</table>
</div>
@endif

@endsection

@section('custom_js')
@endsection