@extends('layouts.apppatients')

@section('content')


<h3>{{ auth()->user()->fullName }}</h3>


<table class="table table-bordered">
    <tr>
        <th>Id muestra</th>
        <th>Fecha de muestra</th>
        <th>Fecha de resultado</th>
        <th>Resultado</th>
    </tr>
    @foreach(auth()->user()->SuspectCases->sortByDesc('id') as $sc)
    <tr>
        <td>{{ $sc->id }}</td>
        <td>{{ $sc->sample_at }}</td>
        <td>{{ $sc->pcr_sars_cov_2_at }}</td>
        <td>{{ $sc->Covid19 }}</td>
    </tr>
    
    @endforeach
</table>

@endsection
