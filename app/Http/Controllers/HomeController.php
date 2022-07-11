<?php

namespace App\Http\Controllers;
use App\EstablishmentUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Log::error('An error message.');
        $establishmentsusers = EstablishmentUser::where('user_id',Auth::id())->get();
        return view('home',compact('establishmentsusers'));
    }
}
