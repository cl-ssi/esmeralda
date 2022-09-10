<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogAccessCu;

class LogAcessCuController extends Controller
{
    public function index()
    {
        $logAccesses = LogAccessCu::with('patient')
            ->latest()
            ->paginate(50);
        return view('patients.logaccess',compact('logAccesses'));
    }
}
