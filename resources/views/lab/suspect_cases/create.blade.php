@extends('layouts.app')

@section('title', 'Nueva sospecha')

@section('content')
<h3 class="mb-3">Nueva sospecha</h3>

<form method="POST" class="form-horizontal" action="{{ route('lab.suspect_cases.store') }}">
    @csrf
    @method('POST')
    <div class="form-row">
        <fieldset class="form-group col-10 col-md-2">
            <label for="for_run">Run</label>
            <input type="hidden" class="form-control" id="for_id" name="id">
            <input type="text" class="form-control" id="for_run" name="run">
        </fieldset>

        <fieldset class="form-group col-2 col-md-1">
            <label for="for_dv">DV</label>
            <input type="text" class="form-control" id="for_dv" name="dv" readonly>
        </fieldset>

        <fieldset class="form-group col-12 col-md-2">
            <label for="for_other_identification">Otra identificación</label>
            <input type="text" class="form-control" id="for_other_identification"
                placeholder="Extranjeros sin run" name="other_identification">
        </fieldset>

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_gender">Genero</label>
            <select name="gender" id="for_gender" class="form-control">
                <option value="male">Masculino</option>
                <option value="female">Femenino</option>
                <option value="other">Otro</option>
                <option value="unknown">Desconocido</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_birthday">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="for_birthday"
                name="birthday">
        </fieldset>

    </div>

    <div class="form-row">
        <fieldset class="form-group col-12 col-md-3">
            <label for="for_name">Nombres</label>
            <input type="text" class="form-control" id="for_name" name="name">
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_fathers_family">Apellido Paterno</label>
            <input type="text" class="form-control" id="for_fathers_family"
                name="fathers_family">
        </fieldset>

        <fieldset class="form-group col-12 col-md-3">
            <label for="for_mothers_family">Apellido Materno</label>
            <input type="text" class="form-control" id="for_mothers_family"
                name="mothers_family">
        </fieldset>


    </div>

    <hr>

    <div class="form-row">

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_sample_at">Fecha Muestra</label>
            <input type="date" class="form-control" id="for_sample_at"
                name="sample_at" required>
        </fieldset>

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_origin">Origen</label>
            <select name="origin" id="for_origin" class="form-control">
                <option value=""></option>
                <option value="Hospital ETG">Hosptial ETG</option>
                <option value="Clínica Tarapacá">Clínica Tarapacá</option>
                <option value="Clínica Iquique">Clínica Iquique</option>
                <option value="Hector Reyno">Hector Reyno</option>
                <option value="CESFAM Guzmán">CESFAM Guzmán</option>
                <option value="Particular (SEREMI)">Particular (SEREMI)</option>
            </select>
        </fieldset>


        <fieldset class="form-group col-8 col-md-4">
            <label for="for_status">Estado</label>
            <select name="status" id="for_status" class="form-control">
                <option value=""></option>
                <option value="Hospitalizado Básico">Hospitalizado Básico</option>
                <option value="Hospitalizado Crítico">Hospitalizado Crítico</option>
                <option value="Alta">Alta</option>
                <option value="Fallecido">Fallecido</option>
                <option value="Ambulatorio">Ambulatorio (domiciliario)</option>
            </select>
        </fieldset>

        <fieldset class="form-group col-4 col-md-2">
            <label for="for_age">Edad</label>
            <input type="number" class="form-control" id="for_age" name="age">
        </fieldset>

    </div>

    <div class="form-row">

        <fieldset class="form-group col-6 col-md-2 alert-warning">
            <label for="for_result_ifd_at">Fecha Resultado IFD</label>
            <input type="date" class="form-control" id="for_result_ifd_at"
                name="result_ifd_at">
        </fieldset>

        <fieldset class="form-group col-6 col-md-2 alert-warning">
            <label for="for_result_ifd">Resultado IFD</label>
            <select name="result_ifd" id="for_result_ifd" class="form-control">
                <option ></option>
                <option value="Negativo">Negativo</option>
                <option value="Adenovirus">Adenovirus</option>
                <option value="Influenza A">Influenza A</option>
                <option value="Influenza B">Influenza B</option>
                <option value="Metapneumovirus">Metapneumovirus</option>
                <option value="Parainfluenza 1">Parainfluenza 1</option>
                <option value="Parainfluenza 2">Parainfluenza 2</option>
                <option value="Parainfluenza 3">Parainfluenza 3</option>
                <option value="VRS">VRS</option>
                <option value="No procesado">No procesado</option>
            </select>
        </fieldset>


        <fieldset class="form-group col-6 col-md-2 alert-warning">
            <label for="for_subtype">Subtipo</label>
            <select name="subtype" id="for_subtype" class="form-control">
                <option value=""></option>
                <option value="H1N1">H1N1</option>
                <option value="H3N2">H3N2</option>
                <option value="INF B">INF B</option>
            </select>
        </fieldset>

    </div>

    <div class="form-row">

        <fieldset class="form-group col-6 col-md-2 alert-danger">
            <label for="for_sent_isp_at">Fecha envío a ISP</label>
            <input type="date" class="form-control" id="for_sent_isp_at"
                name="sent_isp_at">
        </fieldset>

        <fieldset class="form-group col-6 col-md-2 alert-danger">
            <label for="for_pscr_sars_cov_2_at">Fecha Resultado PCR</label>
            <input type="date" class="form-control" id="for_pscr_sars_cov_2_at"
                name="pscr_sars_cov_2_at">
        </fieldset>

        <fieldset class="form-group col-6 col-md-2 alert-danger">
            <label for="for_pscr_sars_cov_2">PCR SARS-Cov2</label>
            <select name="pscr_sars_cov_2" id="for_pscr_sars_cov_2"
                class="form-control">
                <option value="pending">Pendiente</option>
                <option value="negative">Negativo</option>
                <option value="positive">Positivo</option>
            </select>
        </fieldset>

    </div>

    <div class="form-row">

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_paho_flu">PAHO FLU</label>
            <input type="number" class="form-control" name="paho_flu"
                id="for_paho_flu">
        </fieldset>

        <fieldset class="form-group col-6 col-md-2">
            <label for="for_epivigila">Epivigila</label>
            <input type="number" class="form-control" id="for_epivigila"
                name="epivigila">
        </fieldset>

        <fieldset class="form-group col-12 col-md-8">
            <label for="for_observation">Observación</label>
            <input type="text" class="form-control" name="observation"
                id="for_observation">
        </fieldset>

    </div>


    <button type="submit" class="btn btn-primary">Guardar</button>

    <a class="btn btn-outline-secondary" href="{{ route('lab.suspect_cases.index') }}">
        Cancelar
    </a>
</form>

@endsection

@section('custom_js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src='{{asset('js/jquery.rut.chileno.js')}}'></script>
<script type="text/javascript">
jQuery(document).ready(function($){
    //obtiene digito verificador
    $('input[name=run]').keyup(function(e) {
        var str = $("#for_run").val();
        $('#for_dv').val($.rut.dv(str));
    });

  $('input[name=run]').change(function() {
    var str = $("#for_run").val();
    $.get('{{ route('patients.get')}}/'+str, function(data) {
       if(data){
         document.getElementById("for_id").value = data.id;
         document.getElementById("for_other_identification").value = data.other_identification;
         document.getElementById("for_gender").value = data.gender;
         document.getElementById("for_birthday").value = data.birthday;
         document.getElementById("for_name").value = data.name;
         document.getElementById("for_fathers_family").value = data.fathers_family;
         document.getElementById("for_mothers_family").value = data.mothers_family;
       }else{
         document.getElementById("for_id").value = "";
         document.getElementById("for_other_identification").value = "";
         document.getElementById("for_gender").value = "";
         document.getElementById("for_birthday").value = "";
         document.getElementById("for_name").value = "";
         document.getElementById("for_fathers_family").value = "";
         document.getElementById("for_mothers_family").value = "";
       }
     });
  });

});

</script>

@endsection
