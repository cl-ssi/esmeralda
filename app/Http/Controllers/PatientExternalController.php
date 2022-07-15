<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Patient;

class PatientExternalController extends Controller
{
    //

    public function showLoginForm()
    {
        
        return view('auth.login-patient');
    }

    /**
     * Overwrite username por id
     *
     */
    

    public function home()
    {
        return view('homepatient');
    }

    

    public function login(Request $request)
    {       
        

        $this->validate($request, [
            'run'           => 'required|max:255',
        ]);

        $credentials = $request->only('run', 'password');
        $credentials['run'] = str_replace('.','',$credentials['run']);
        $credentials['run'] = str_replace('-','',$credentials['run']);
        $credentials['run'] = substr($credentials['run'], 0, -1);

        $run = $credentials['run'];

        $patient = Patient::where('run', $run)->first();

        if($patient) {
            Auth::guard('patients')->login($patient);            
            return redirect()->route('examenes.home');
        }
        else {         

            session()->flash('danger', 'La cuenta de usuario no existe o no está activa.');
            return redirect()->back();
        }       
        

    }

    public function logout(){                
        Auth::guard('patients')->logout();
        return redirect()->route('welcome');
        
    }
    
    

}
