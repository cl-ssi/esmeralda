@extends('layouts.app')

@section('title', 'Log Access')

@section('content')

<h3 class="mb-3">Log Access</h3>

<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <tr>
                <th>Id</th>
                <th>Paciente</th>
				<th>Ultimo exámen</th>
                <th>Fecha</th>
            </tr>
        </tr>
    </thead>
    <tbody>
        @foreach($logAccesses as $access)
        <tr>
            <td>{{ $access->id }}</td>
            <td><a href="{{ route('patients.edit',$access->patient) }}">{{ $access->patient->fullName }}</a></td>
            <td>
				<a href="{{ route('patients.pcrs', $access->patient) }}"
					class="{{ $access->patient->lastExam->pcr_sars_cov_2 == 'positive' ? 'text-danger' : '' }}">
					{{ $access->patient->lastExam->sample_at }} - 
					{{ $access->patient->lastExam->pcr_sars_cov_2 }}
				</a>
				<span class="badge badge-secondary">{{ $access->patient->suspect_cases_count }}</span>
			</td>
            <td>{{ $access->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $logAccesses->links() }}

@endsection