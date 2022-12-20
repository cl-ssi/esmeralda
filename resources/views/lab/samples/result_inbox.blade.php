@extends('layouts.app')

@section('title', 'Resultado Muestra')

@section('content')
<h3 class="mb-3"><i class="fas fa-lungs-virus"></i>
    Resultados de {{ $sampleProcedure->name }}
</h3>

<div class="table-responsive">
    <table class="table table-sm table-bordered" id="tabla_casos">
        <thead>
            <tr>
                <th nowrap>Nº</th>
                <th>Prestación</th>
                <th>Fecha muestra</th>
                <th>Origen Establecimiento</th>
                <th>Fecha de recepción</th>
                <th>Examenes</th>
            </tr>
        </thead>
        <tbody id="tableCases">
            @foreach($samples as $sample)
            <tr>
                <td class="text-center">
                    {{ $sample->id }}
                    <a href="{{ route('lab.samples.edit', $sample) }}" class="btn_edit"><i class="fas fa-edit"></i></a>
                </td>
                <td>{{ $sample->procedure_name }}</td>
                <td nowrap class="small">{{$sample->sample_at}} </td>
                <td>{{ ($sample->establishment) ? $sample->establishment->alias : '' }}</td>
                <td nowrap class="small">{{$sample->reception_at}} </td>
                <td class="small">
                    @foreach($sample->sampleResults as $examResult)
                    {{$examResult->exam_name }} ({{$examResult->result}})<br>

                    @endforeach

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


@endsection

@section('custom_js')

@endsection