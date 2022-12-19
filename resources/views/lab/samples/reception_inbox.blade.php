@extends('layouts.app')

@section('title', 'Recepcionar Muestra')

@section('content')
<table class="table table-sm table-bordered table-responsive" id="tabla_casos">
    <thead>
    </thead>
    <tr>
        <th nowrap>N°</th>
        <th></th>
        <th>Prestación</th>
        <th>Fecha Muestra</th>
        <th>Establecimiento</th>
    </tr>
    <tbody id="tableCases">
        @foreach($samples as $sample)
        <tr>
            <td class="text-center">{{ $sample->id }}</td>
            <td>
                <form method="POST" class="form-inline" action="{{ route('lab.samples.reception', $sample) }}">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-sm btn-primary" title="Recepcionar"><i class="fas fa-inbox"></i></button>
                </form>
            </td>
            <td>{{ $sample->procedure_name }}</td>
            <td nowrap class="small">{{$sample->sample_at}} </td>
            <td>{{ ($sample->establishment) ? $sample->establishment->alias : '' }}</td>
        </tr>

        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection