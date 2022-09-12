@extends('layouts.app')

@section('title', 'PCRS')

@section('content')

<h3>{{ $patient->fullName }}</h3>

<table class="table table-bordered">
	<tr>
		<th class="d-none d-sm-block">Id</th>
		<th>Fecha de muestra</th>
		<th>Fecha de resultado</th>
		<th>Resultado</th>
        <th></th>
	</tr>
	
	@foreach($patient->SuspectCases->sortByDesc('id') as $sc)
	
	<tr>
		<td class="d-none d-sm-block">{{ $sc->id }}</td>
		<td>{{ $sc->sample_at }}</td>
		<td>{{ $sc->pcr_sars_cov_2_at }}</td>
		<td class="h5 {{ $sc->pcr_sars_cov_2 == 'positive' ? 'text-danger' : '' }}">
            {{ $sc->Covid19 }}
            {{ $sc->pcr_sars_cov_2 == 'positive' ? '🥵' : '' }}
		<td>
			@if($sc->file)
				<a href="{{ route('examenes.download', $sc->id) }}"
					target="_blank"><i class="fas fa-file-pdf"></i>
				</a>
			@endif
		</td>
	</tr>

	@endforeach
</table>

@endsection