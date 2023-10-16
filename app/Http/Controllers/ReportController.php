<?php

namespace App\Http\Controllers;

use App\Models\MonitoringPoint;
use App\Models\Quality;
use App\Models\Quantity;
use App\Models\SamplingTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){

    }

    public function reportQuality(){
        $data = SamplingTime::latest()->with('quality')->paginate(1);
        return response()->json($data,200);
    }

    public function reportQuantity(){
        $data = Quantity::with('monitoring_point')->with('user')->all();
        return response()->json($data,200);
    }
}
