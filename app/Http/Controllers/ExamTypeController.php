<?php

namespace App\Http\Controllers;

use App\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Se recuperan todos los tipos de exámenes de la base de datos, ordenados por el nombre en orden ascendente
        $exam_types = ExamType::orderby('name', 'ASC')
            ->get();

        // Se muestra la vista "parameters.exam_types.index" y se pasan los tipos de exámenes como parámetro
        return view('parameters.exam_types.index', compact('exam_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('parameters.exam_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'values' => 'required|string',
            'unit' => 'nullable|string',
            'reference_range' => 'nullable|string',
        ]);

        // Separar los valores en un arreglo
        $values = explode(',', $data['values']);
        // Convertir el arreglo a JSON
        $values = json_encode($values);

        ExamType::create([
            'name' => $data['name'],
            'values' => $values,
            'unit' => $data['unit'],
            'reference_range' => $data['reference_range'],
        ]);

        return redirect()->route('parameters.exam_types.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function show(ExamType $examType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamType $examType)
    {
        // Se muestra la vista "parameters.exam_types.edit" y se pasan el tipo de examen a editar como parámetro
        return view('parameters.exam_types.edit', compact('examType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamType $examType)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'values' => 'required|string',
        ]);

        // Actualizar el tipo de examen
        $examType->fill($request->all());
        // Separar los valores en un arreglo
        $values = explode(',', $request->values);
        // Convertir el arreglo a JSON
        $values = json_encode($values);
        
        $examType->values = $values;
        $examType->save();



        // Mostrar un mensaje de éxito
        session()->flash('success', '¡El Tipo de examen ha sido actualizado!');

        // Redirigir al usuario a la lista de tipos de examen
        return redirect()->route('parameters.exam_types.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamType  $examType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamType $examType)
    {
        //
    }
}
