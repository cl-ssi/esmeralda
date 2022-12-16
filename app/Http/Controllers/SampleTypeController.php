<?php

namespace App\Http\Controllers;

use App\SampleType;
use Illuminate\Http\Request;

class SampleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sample_types = SampleType::orderby('name', 'ASC')
            ->get();

        return view('parameters.sample_types.index', compact('sample_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('parameters.sample_types.create');
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
        $sample_type = new SampleType($request->All());
        $sample_type->save();

        session()->flash('success', 'Se creo el tipo de muestra exitosamente');
        return redirect()->route('parameters.sample_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SampleType  $sampleType
     * @return \Illuminate\Http\Response
     */
    public function show(SampleType $sampleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SampleType  $sampleType
     * @return \Illuminate\Http\Response
     */
    public function edit(SampleType $sampleType)
    {
        //
        return view('parameters.sample_types.edit', compact('sampleType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SampleType  $sampleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SampleType $sampleType)
    {
        //
        $sampleType->fill($request->all());
        $sampleType->save();
        session()->flash('success', '¡El Tipo de tipo de muestra ha sido actualizado!');
      return redirect()->route('parameters.sample_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SampleType  $sampleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SampleType $sampleType)
    {
        //
    }
}
