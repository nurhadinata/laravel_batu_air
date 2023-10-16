<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Models\Quantity;
use App\Models\SamplingTime;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $lastSamplingTime = SamplingTime::whereHas('quality')->orderBy('time', 'DESC')->with('quality')->get();
        echo($lastSamplingTime);
    }

    public function upper() {
        $time = SamplingTime::select('time')->orderBy('time', 'DESC') ->get();

        $ika = Quality::join('sampling_times', 'qualities.sampling_time_id', '=', 'sampling_times.id')
        ->where('sampling_times.time', $time[0]['time'])
        ->avg('wqi');

        $ika_before = Quality::join('sampling_times', 'qualities.sampling_time_id', '=', 'sampling_times.id')
        ->where('sampling_times.time', $time[1]['time'])
        ->avg('wqi');

        $ika_comparison = $ika > $ika_before ? 'Naik' : 'Turun'; 

        $ipj = Quality::join('sampling_times', 'qualities.sampling_time_id', '=', 'sampling_times.id')
        ->where('sampling_times.time', $time[0]['time'])
        ->avg('wpi');

        $ipj_before = Quality::join('sampling_times', 'qualities.sampling_time_id', '=', 'sampling_times.id')
        ->where('sampling_times.time', $time[1]['time'])
        ->avg('wpi');

        $quantity = Quantity::where('monitoring_point_id',1)->latest()->with(['monitoring_point'])->take(1)->get();

        $ipj_comparison = $ipj > $ipj_before ? 'Naik' : 'Turun'; 

        $ipj_status = '';

        if ($ipj <= 1) {
            $ipj_status = 'Memenuhi Buku Mutu';
        } else if ($ipj <=5) {
            $ipj_status = 'Cemar Ringan';
        } else if ($ipj <=10) {
            $ipj_status = 'Cemar Sedang';
        } else {
            $ipj_status = 'Cemar Berat';
        }   
        
        $data =array( 
            'ika' => $ika,
            'ika_comparison' => $ika_comparison,
            'ipj' => $ipj,
            'ipj_comparison' => $ipj_comparison,
            'status' => $ipj_status,
            'quantity' => $quantity
        );

        return $data;
    }

    public function middle() {
        $data = Quality::select('time', 'quarter', DB::raw('avg(wqi) as wqi, avg(wpi) as wpi'))
        ->join('sampling_times', 'qualities.sampling_time_id', '=', 'sampling_times.id')
        ->groupBy('time')
        ->paginate(10);

        return response()->json($data,200);
    }

    public function bottom(){
        $data = SamplingTime::with('quality')->orderBy('time', 'DESC')->paginate(10);
        return response()->json($data,200);
    }

}
