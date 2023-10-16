<?php

namespace App\Http\Controllers;

use App\Http\Resources\MonitoringPointResource;
use App\Models\Image;
use App\Models\MonitoringPoint;
use App\Models\Quality;
use App\Models\Quantity;
use Illuminate\Http\Request;

class MonitoringPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $monitoringPoint = MonitoringPoint::all();

        return MonitoringPointResource::collection(MonitoringPoint::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonitoringPoint  $monitoringPoint
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ika = Quality::where('monitoring_point_id', $id)->latest()->value('wqi');
        $ipj = Quality::where('monitoring_point_id', $id)->latest()->value('wpi');
        $ph = Quality::where('monitoring_point_id', $id)->latest()->value('ph');
        $status = Quality::where('monitoring_point_id',$id)->latest()->value('status');
        $ika_before = Quality::where('monitoring_point_id', $id)->latest()->skip(1)->take(1)->value('wqi');
        $ika_comparison = $ika >= $ika_before ? 'Naik' : 'Turun';
        $ipj_before = Quality::where('monitoring_point_id', $id)->latest()->skip(1)->take(1)->value('wpi');
        $ipj_comparison = $ipj >= $ipj_before ? 'Naik' : 'Turun';
        $ipj_status = "";
        if ($ipj <= 1) {
            $ipj_status = 'Memenuhi Buku Mutu';
        } else if ($ipj <=5) {
            $ipj_status = 'Cemar Ringan';
        } else if ($ipj <=10) {
            $ipj_status = 'Cemar Sedang';
        } else {
            $ipj_status = 'Cemar Berat';
        }
        $data =array();
        $data['kualitas'] = array( 
            'ika' => $ika,
            'ipj' => $ipj,
            'ph' => $ph,
            'status' => $ipj_status,
            'ika_comparison' => $ika_comparison,
            'ipj_comparison' => $ipj_comparison,
        );
        $data['monitoring_point'] = MonitoringPoint::where('id',$id)->with('image')->get()[0];
        return response()->json($data,200);
    }

    public function quality($id)
    {
        $data = Quality::where('monitoring_point_id',$id)->get();
        return response()->json($data,200);
    }

    public function latestQuality($id)
    {
        $data = Quality::where('monitoring_point_id',$id)->latest()->get();
        return response()->json($data,200);
    }

    public function quantity($id)
    {
        $data = Quantity::where('monitoring_point_id',$id)->latest()->with(['monitoring_point'])->paginate(request('size')??25);
        return response()->json($data,200);
    }

    public function latestQuantity($id)
    {
        $data = Quantity::where('monitoring_point_id',$id)->latest()->get();
        return response()->json($data,200);
    }

    public function detail($id){
        $monitoringPoint = MonitoringPoint::where('id',$id)->get();
        $status = Quality::where('monitoring_point_id',$id)->latest()->get();
        $images = Image::where('monitoring_point_id', $id)->get();

        $data =array( 
            'monitoring_point' => $monitoringPoint,
            'status' => $status,
            'images' => $images
        );

        return response()->json($data,200);
    }

    public function detailQuality($id){
        $monitoringPoint = MonitoringPoint::where('id',$id)->value('monitoring_point');
        $ika = Quality::where('monitoring_point_id', $id)->latest()->value('wqi');
        $ipj = Quality::where('monitoring_point_id', $id)->latest()->value('wpi');
        $ph = Quality::where('monitoring_point_id', $id)->latest()->value('ph');
        $status = Quality::where('monitoring_point_id',$id)->latest()->value('status');
        $ika_before = Quality::where('monitoring_point_id', $id)->latest()->skip(1)->take(1)->value('wqi');
        $ika_comparison = $ika >= $ika_before ? 'Naik' : 'Turun';
        $ipj_before = Quality::where('monitoring_point_id', $id)->latest()->skip(1)->take(1)->value('wpi');
        $ipj_comparison = $ipj >= $ipj_before ? 'Naik' : 'Turun';
        $data =array( 
            'monitoring_point' => $monitoringPoint,
            'ika' => $ika,
            'ipj' => $ipj,
            'ph' => $ph,
            'status' => $status,
            'ika_comparison' => $ika_comparison,
            'ipj_comparison' => $ipj_comparison,
        );

        return response()->json($data,200);
    }

    public function diagramQuality($id){
        $data = Quality::where('monitoring_point_id',$id)
        ->join('sampling_times', 'qualities.sampling_time_id', '=', 'sampling_times.id')
        ->groupBy('time')
        ->paginate(10);

        return response()->json($data,200);
    }

    public function addQuantity($id){
        $value = request('value'); 
        $fix = 0;
        $kedalaman = 0;
        switch ($id) {
            case 1:
                $fix = 30;
                $kedalaman = 30;
                break;
            case 2:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 3:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 4:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 5:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 6:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 7:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 8:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 9:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 10:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 11:
                $fix = 0;
                $kedalaman = 0;
                break;
            case 12:
                $fix = 0;
                $kedalaman = 0;
                break;
            default:
                $fix = 0;
                $kedalaman = 0;
                break;
        }

        $kedalaman_total = $kedalaman + ($fix-$value);
        
        $quantity = Quantity::create([
            "monitoring_point_id"=>$id,
            "height_above_water"=>$kedalaman_total
        ]);
        return response()->json($quantity, 200);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonitoringPoint  $monitoringPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(MonitoringPoint $monitoringPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonitoringPoint  $monitoringPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonitoringPoint $monitoringPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonitoringPoint  $monitoringPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonitoringPoint $monitoringPoint)
    {
        //
    }
}
