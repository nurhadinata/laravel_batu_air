<?php

namespace App\Http\Controllers;

use App\Models\MonitoringPoint;
use App\Models\Quality;
use App\Models\Quantity;
use App\Models\SamplingTime;
use Illuminate\Http\Request;

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
        return view('home');
    }

    public function data(){
        return view('data');
    }

    public function input(){
        return view('input');
    }


}
