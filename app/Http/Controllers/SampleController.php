<?php

namespace App\Http\Controllers;

use App\Sample;
use Illuminate\Http\Request;
use App\EstablishmentUser;
use App\SampleType;
use App\SampleResult;
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
    public function create()
    {
        //

        $establishmentsusers = EstablishmentUser::where('user_id', Auth::id())->get();


        $sample_types = SampleType::orderby('name', 'ASC')->get();



        // Se muestra la vista para crear una nueva muestra
        return view('lab.samples.create', compact('establishmentsusers', 'sample_types'));
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

        SampleResult::create([
            'sample_id' => $sample->id,
            //'exam_type' => $procedureType,
        ]);


        session()->flash('success', 'Se ha creado la muestra  número: <h3>'
            . $sample->id .'</h3>');

        return redirect()->back();

        
    }

    public function reception_inbox(Request $request)
    {
        //dd('kaka');

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
