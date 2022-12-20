<?php

namespace App\Http\Controllers;

use App\Sample;
use Illuminate\Http\Request;
use App\EstablishmentUser;
use App\SampleType;
use App\SampleResult;
use App\SampleProcedure;
use App\Establishment;
use App\Country;
use App\Region;
use App\Commune;
use App\SampleOrigin;
use App\Rules\UniqueSampleDateByPatient;
use App\Patient;
use App\Demographic;

use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SampleProcedure $sampleProcedure)
    {
        //

        $establishmentsusers = EstablishmentUser::where('user_id', Auth::id())->get();


        $sample_types = SampleType::orderby('name', 'ASC')->get();

        $regions = Region::orderBy('id', 'ASC')->get();
        $communes = Commune::orderBy('id', 'ASC')->get();
        $countries = Country::select('name')->orderBy('id', 'ASC')->get();
        $sampleOrigins = SampleOrigin::orderBy('name')->pluck('name');



        // Se muestra la vista para crear una nueva muestra
        return view('lab.samples.create', compact('establishmentsusers', 'sample_types', 'sampleProcedure', 'regions', 'communes', 'countries', 'sampleOrigins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'id' => new UniqueSampleDateByPatient($request->sample_at),
            'email' => 'nullable|email:rfc'
        ], [
            'email' => 'Debe ingresar un email válido.'
        ]);

        /* Si existe el paciente lo actualiza, si no, crea uno nuevo */
        if ($request->id == null) {
            $patient = new Patient($request->All());
        } else {
            $patient = Patient::find($request->id);
            $patient->fill($request->all());
        }
        $patient->save();

        if ($patient->demographic) {
            $patient->demographic->fill($request->all());
            $patient->demographic->save();
        } else {
            $demographic = new Demographic($request->All());
            $demographic->patient_id = $patient->id;
            $demographic->save();
        }



        $sample = new Sample($request->All());
        $sample->user_id = Auth::id();
        $sample->patient_id  = $patient->id;
        $sample->save();

        foreach ($sample->procedure->exams as $exam) {
            SampleResult::create([
                'sample_id' => $sample->id,
                'exam_id' => $exam->id,
                'exam_name' => $exam->name,
                'result' => 'No Solicitado',
            ]);
        }


        session()->flash('success', 'Se ha creado la muestra  número: <h3>'
            . $sample->id . '</h3>');

        return redirect()->back();
    }

    public function reception_inbox(Request $request, SampleProcedure $sampleProcedure)
    {
        $samples = Sample::where('procedure_id', $sampleProcedure->id)
            ->whereNull('reception_at')
            ->get();


        return view('lab.samples.reception_inbox', compact('samples'));
    }

    public function result_inbox(Request $request, SampleProcedure $sampleProcedure)
    {
        $samples = Sample::where('procedure_id', $sampleProcedure->id)
            ->whereNotNull('reception_at')
            ->get();


        return view('lab.samples.result_inbox', compact('samples', 'sampleProcedure'));
    }

    public function reception(Request $request, Sample $sample)
    {
        $sample->reception_at = date('Y-m-d H:i:s');
        $sample->receptor_id = Auth::id();
        
        
        /* La muestra se recepciona al laboratorio asignado al usuario*/
        if (Auth::user()->laboratory_id) {
            $sample->laboratory_id = Auth::user()->laboratory_id;
        }
        $sample->save();

        session()->flash('success', 'Se ha Recepcionado exitosamente la muestra');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function edit(Sample $sample)
    {
        $sample_types = SampleType::orderby('name', 'ASC')->get();
        // $establishments = Establishment::whereIn('commune_id', explode(',', env('COMUNAS')))
        //     ->orderBy('name', 'ASC')->get();
        // TODO
        // ver por que no me funciona el explode del .env
        $establishments = Establishment::whereIn('commune_id',  [5, 6, 7, 8, 9, 10, 11])->get();

        $sampleOrigins = SampleOrigin::orderBy('alias')->get();

        //
        return view('lab.samples.edit', compact('sample', 'sample_types', 'establishments', 'sampleOrigins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sample $sample)
    {
        //
        $sample->fill($request->all());
        $sample->save();
        //$sample->sampleResults()->sync($request->input('results'));
        session()->flash('success', 'Se Actualizó exitosamente la muestra');
        return redirect()->back();
    }

    public function update_result(Request $request, SampleResult $sampleResult)
    {
        // Obtener el valor del resultado del formulario        
        $result = $request->input('result');

        // Actualizar el resultado del examen
        $sampleResult->update(['result' => $result]);

        session()->flash('success', 'Se Actualizó exitosamente el resultado');

        // Redirigir a la vista deseada
        return redirect()->back();
    }

    public function update_file(Request $request, Sample $sample)
    {
        // Obtener el valor del resultado del formulario        
        $result_at = $request->input('result_at');

        $sample->update(['result_at' => $result_at]);
        session()->flash('success', 'Se Subio la fecha de resultado y el archivo correctamente');
        // Redirigir a la vista deseada
        return redirect()->back();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        //

    }
}
