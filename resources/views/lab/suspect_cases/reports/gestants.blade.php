@extends('layouts.app')

@section('title', 'Gestantes')

@section('content')
<h3 class="mb-3">Gestantes</h3>

<h4>Total: {{ $patients->total() }}</h4>


<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>RUN o ID</th>
            <th>Edad</th>
            <th>Comuna</th>
            <th>Nacionalidad</th>
            <th>Estado</th>
            <th>Exámenes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
        <tr class="{{ ($covid = $patient->suspectCases->where('pcr_sars_cov_2','positive')->count() > 0)?'table-active':'' }}">
            <td>{{ $patient->id }}</td>
            <td>
                <a href="{{ route('patients.edit', $patient)}}">
                    {{ $patient->fullName }}
                </a>
            </td>
            <td>{{ $patient->identifier }}</td>
            <td>{{ $patient->age }}</td>
            <td>{{ ($patient->demographic AND $patient->demographic->commune) ? $patient->demographic->commune->name : '' }}</td>
            <td>{{ ($patient->demographic) ? $patient->demographic->nationality : '' }}</td>
            <td>{{ $patient->status }}</td>
            <td>
                @foreach($patient->suspectCases as $case)
                <a href="{{ route('lab.suspect_cases.edit', $case) }}" target="_blank">
                    {{ ($case->pcr_sars_cov_2_at)?$case->pcr_sars_cov_2_at->format('Y-m-d'):'' }}
                    {{ $case->covid19 }}
                </a> <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{{ $patients->links() }}


@endsection

@section('custom_js')

@endsection
