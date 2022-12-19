<?php

namespace App\Http\Controllers;

use App\Sample;
use Illuminate\Http\Request;
use App\EstablishmentUser;
use App\SampleType;
use App\SampleResult;
use App\SampleProcedure;

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



        // Se muestra la vista para crear una nueva muestra
        return view('lab.samples.create', compact('establishmentsusers', 'sample_types', 'sampleProcedure'));
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
        $sample = new Sample($request->All());
        $sample->user_id = Auth::id();
        $sample->save();

        foreach ($sample->procedure->exams as $exam) {
            SampleResult::create([
                'sample_id' => $sample->id,
                'exam_id' => $exam->id,
                'exam_name' => $exam->name,
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

    public function reception(Request $request, Sample $sample)
    {
        $sample->reception_at = date('Y-m-d H:i:s');
        $sample->save();

        session()->flash('success', 'Se ha Recepciono exitosamente la muestra');
        
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
        //
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
