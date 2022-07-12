<?php

namespace App\Http\Controllers;

use App\SanitaryResidence\VitalSign;
use App\SanitaryResidence\Booking;
use Illuminate\Http\Request;
use App\Log;

class VitalSignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    //     $vitalsigns = VitalSign::all();
    //     return view('sanitary_residences.vital_signs.index', compact('vitalsigns'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bookings = Booking::All();
        return view('sanitary_residences.vital_signs.create', compact('bookings'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->vitalsign_id == null){
          $vitalsign = new VitalSign($request->All());
          $vitalsign->patient_id = $vitalsign->booking->patient->id;
          $vitalsign->user_id = auth()->user()->id;
          $vitalsign->save();
          session()->flash('success', 'Se guardó la información.');
        }else{
          //$vitalsign = VitalSign::where('id',$request->vitalsign_id)->first();
          $vitalsign = VitalSign::find($request->vitalsign_id);
          $vitalsign->fill($request->All());
          $vitalsign->save();
          session()->flash('success', 'Se modificó la información.');
        }

        $logPatient = new Log();
        $logPatient->old = clone $vitalsign;

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SanitaryResidence\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function show(VitalSign $vitalSign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SanitaryResidence\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function edit(VitalSign $vitalSign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SanitaryResidence\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VitalSign $vitalSign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SanitaryResidence\VitalSign  $vitalSign
     * @return \Illuminate\Http\Response
     */
    public function destroy(VitalSign $vitalSign)
    {
        //
    }
}
