<?php

namespace App\Http\Controllers;

use App\SampleProcedure;
use App\SampleProcedureExam;
use App\ExamType;
use Illuminate\Http\Request;

class SampleProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sampleProcedures = SampleProcedure::orderby('name', 'ASC')->get();

        return view('parameters.sample_procedures.index', compact('sampleProcedures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $examTypes = ExamType::orderby('name', 'ASC')->get();
        return view('parameters.sample_procedures.create', compact('examTypes'));
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
            'name' => 'required',
            'exam_id' => 'required',
        ]);

        // Crea un Procedimiento y en la pivote
        $sampleProcedure = new SampleProcedure;
        $sampleProcedure->name = $request->input('name');
        $sampleProcedure->save();
        $sampleProcedureExam = new SampleProcedureExam;
        $sampleProcedureExam->procedure_id = $sampleProcedure->id;
        $sampleProcedureExam->exam_id = $request->input('exam_id');
        $sampleProcedureExam->save();

        // Muestra mensaje de exito
        session()->flash('success', 'El procedimiento Se creo con éxito');
        return redirect()->route('parameters.sample_procedures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SampleProcedure  $sampleProcedure
     * @return \Illuminate\Http\Response
     */
    public function show(SampleProcedure $sampleProcedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SampleProcedure  $sampleProcedure
     * @return \Illuminate\Http\Response
     */
    public function edit(SampleProcedure $sampleProcedure)
    {
        //
        $examTypes = ExamType::orderby('name', 'ASC')->get();


        return view('parameters.sample_procedures.edit', compact('sampleProcedure', 'examTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SampleProcedure  $sampleProcedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SampleProcedure $sampleProcedure)
    {
        //
        $procedure = SampleProcedureExam::firstOrCreate(
            ['procedure_id' => $sampleProcedure->id, 'exam_id' => $request->exam_id],
            ['procedure_id' => $sampleProcedure->id, 'exam_id' => $request->exam_id]
        );

        if ($procedure->wasRecentlyCreated) {
            session()->flash('info', 'El Examen fue agregado con éxito.');
        } else {
            session()->flash('danger', 'El Examen que desea Agregar ya se encontraba registrado');
        }
        return redirect()->route('parameters.sample_procedures.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SampleProcedure  $sampleProcedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(SampleProcedure $sampleProcedure)
    {
        // Eliminar las relaciones entre el procedimiento y los exámenes
        $sampleProcedure->exams()->detach();

        // Eliminar el procedimiento
        $sampleProcedure->delete();

        // Redirigir al index con un mensaje de éxito
        return redirect()->route('parameters.sample_procedures.index')->with('success', 'El procedimiento y sus exámenes relacionados han sido eliminados');
    }
}
