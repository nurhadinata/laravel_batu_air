<?php

namespace App\Http\Controllers;

use App\Models\MonitoringPoint;
use App\Models\Quality;
use App\Http\Controllers\QualityController;
use App\Models\Quantity;
use App\Models\SamplingTime;
use App\Models\WaterIdx;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'counter' => 1,
            'quality' => Quality::with(['monitoring_point', 'sampling_time'])->get(),
            'monitoring_point' => MonitoringPoint::latest()->get(),
            'sampling_time' => SamplingTime::orderBy('time', 'DESC')->get()
        ];
        return view('home', $data);
    }

    public function input(){
        $data = [
    
            'monitoring_point' => MonitoringPoint::latest()->get(),
            'sampling_time' => SamplingTime::orderBy('time', 'DESC')->get()
        ];
        return view('input', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'monitoring_point_id' => 'required',
            'sampling_time_id' => 'required',
        ]);
        
        $wqi = $this->qualityIndex($request);
        $wpi = $this->polutionIndex($request);
        $status = $this->status($wpi);

        Quality::create([
            'monitoring_point_id' =>$request->monitoring_point_id,
            'sampling_time_id' => $request->sampling_time_id,
            'users_id' => $request->user()->id, 
            'wqi' => $wqi,
            'wpi' => $wpi,
            'status' => $status,
            'temperature' => $request->temperature, 
            'ph' => $request->ph, 
            'dhl' => $request->dhl, 
            'tds' => $request->tds, 
            'tss' => $request->tss, 
            'do' => $request->do, 
            'bod' => $request->bod, 
            'cod' => $request->cod, 
            'no_2' => $request->no_2,
            'no_3' => $request->no_3,
            'nh_2' => $request->nh_2,
            'clorin' => $request->clorin,
            'total_fosfat' => $request->fosfat,
            'fenol' => $request->fenol,
            'oil' => $request->oil,
            'detergent' => $request->detergent,
            'fecal_coliform' => $request->fecal_coliform,
            'total_coliform' => $request->total_coliform,
            'cyanide' => $request->cyanide,
            'h2s' => $request->h2s
        ]);

        $qualityController = new QualityController;
        $id = WaterIdx::where('sampling_time_id', $request->sampling_time_id)->value('id');
        $qualityController->update($id);
     
        return redirect()->route('admin.index')
                        ->with('success','Input data sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'counter' => 1,
            'quality' => Quality::where('sampling_time_id', $id)->with(['monitoring_point', 'sampling_time'])->get(),
            'sampling_time' => SamplingTime::find($id)
        ];
        return view('detail-quality', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quality = Quality::with('monitoring_point', 'sampling_time')->find($id);
     
        return view('edit', compact('quality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quality = Quality::find($id);
        // Getting values from the blade template form
        $wqi = $this->qualityIndex($request);
        $wpi = $this->polutionIndex($request);
        $status = $this->status($wpi);

        $quality->wqi =  $wqi;
        $quality->wpi = $wpi;
        $quality->status = $status;
        $quality->temperature = $request->temperature; 
        $quality->ph = $request->ph; 
        $quality->dhl = $request->dhl; 
        $quality->tds = $request->tds; 
        $quality->tss = $request->tss; 
        $quality->do = $request->do;
        $quality->bod = $request->bod; 
        $quality->cod = $request->cod; 
        $quality->no_2 = $request->no_2;
        $quality->no_3 = $request->no_3;
        $quality->nh_2 = $request->nh_2;
        $quality->clorin = $request->clorin;
        $quality->total_fosfat = $request->fosfat;
        $quality->fenol = $request->fenol;
        $quality->oil = $request->oil;
        $quality->detergent = $request->detergent;
        $quality->fecal_coliform = $request->fecal_coliform;
        $quality->total_coliform = $request->total_coliform;
        $quality->cyanide = $request->cyanide;
        $quality->h2s = $request->h2s;
        $quality->save();

        $qualityController = new QualityController;
        $id = WaterIdx::where('sampling_time_id', $request->sampling_time_id)->value('id');
        $qualityController->update($id);
        
        return redirect()->back()->with('success', 'Data updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $quality = Quality::find($id);
        $quality->delete();
        return redirect()->back();
     }

     public function destroySampling($id){
        $quality = Quality::where('sampling_time_id', $id);
        $quality->delete();
        return redirect()->back();
     }

    public function delete($id)
    {
        $quality = Quality::find($id);
     
        return view('delete', compact('quality'));
    }

    public function deleteSampling($id)
    {
        $quality = Quality::where('sampling_time_id', $id)->first();
     
        return view('delete-by-sampling', compact('quality'));
    }

    private function qualityIndex(Request $request){
        $wqi = 0.00;
        $f1 = $f2 = $f3 = $tesCount = $varCount = $nse = $excursion = $totalExcursion = 0.00;
        $varTotal = $tesTotal = 9.00;
        $sTemperatureLow = 22.00;
        $sTemperatureHigh = 28.00;
        $sPhLow = 6.00;
        $sPhHigh = 9.00;
        $sTss = 50.00;
        $sDo = 4.00;
        $sBod = 3.00;
        $sCod = 25.00;
        $sTotalFosfat = 0.20;
        $sFecalColiform = 1000.00;
        $sTotalColiform = 5000.00;
        
        if ($request->temperature < $sTemperatureLow && $request->temperature>0){
            $varCount++;
            $tesCount++;
            $excursion = ($sTemperatureLow/$request->temperature)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }elseif($request->temperature > $sTemperatureHigh){
            $varCount++;
            $tesCount++;
            $excursion = ($request->temperature/$sTemperatureHigh)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->ph < $sPhLow && $request->ph>0){
            $varCount++;
            $tesCount++;
            $excursion = ($sPhLow/$request->ph)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }elseif($request->ph > $sPhHigh){
            $varCount++;
            $tesCount++;
            $excursion = ($request->ph/$sPhHigh)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->tss > $sTss){
            $varCount++;
            $tesCount++;
            $excursion = ($request->tss/$sTss)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->do < $sDo  && $request->do>0){
            $varCount++;
            $tesCount++;
            $excursion = ($sDo/$request->do)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->bod > $sBod){
            $varCount++;
            $tesCount++;
            $excursion = ($request->bod/$sBod)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->cod > $sCod){
            $varCount++;
            $tesCount++;
            $excursion = ($request->cod/$sCod)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->total_fosfat > $sTotalFosfat){
            $varCount++;
            $tesCount++;
            $excursion = ($request->total_fosfat/$sTotalFosfat)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->fecal_coliform > $sFecalColiform){
            $varCount++;
            $tesCount++;
            $excursion = ($request->fecal_coliform/$sFecalColiform)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->total_coliform > $sTotalColiform){
            $varCount++;
            $tesCount++;
            $excursion = ($request->total_coliform/$sTotalColiform)-1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        $nse = $totalExcursion/$tesTotal;
        $f1 = $varCount/$varTotal*100;
        $f2 = $tesCount/$tesTotal*100;
        $f3 = $nse/((0.02*$nse)+0.01);

        $wqi =100-sqrt((($f1*$f1)+($f2*$f2)+($f3*$f3))/1.732);

        return $wqi;   
    }

    private function polutionIndex(Request $request){
        $lij = array(25,7,50,4,3,25,0.2,1000,5000);
        $ci_max = array(27.00, 8.00,19.33,4.2,11.22,37.49,0.3,960,4600);
        $ci_lij = array();
        $i = 0;

        $ci_new = ($ci_max[0] - $request->temperature) / ($ci_max[0] - $lij[0]);
        $ci_lij_temp = $ci_new / $lij[0];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[1] - $request->ph) / ($ci_max[1] - $lij[1]);
        $ci_lij_temp = $ci_new / $lij[1];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[2] - $request->tss) / ($ci_max[2] - $lij[2]);
        $ci_lij_temp = $ci_new / $lij[2];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[3] - $request->do) / ($ci_max[3] - $lij[3]);
        $ci_lij_temp = $ci_new / $lij[3];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[4] - $request->bod) / ($ci_max[4] - $lij[4]);
        $ci_lij_temp = $ci_new / $lij[4];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[5] - $request->cod) / ($ci_max[5] - $lij[5]);
        $ci_lij_temp = $ci_new / $lij[5];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[6] - $request->total_fosfat) / ($ci_max[6] - $lij[6]);
        $ci_lij_temp = $ci_new / $lij[6];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[7] - $request->fecal_coliform) / ($ci_max[7] - $lij[7]);
        $ci_lij_temp = $ci_new / $lij[7];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[8] - $request->total_coliform) / ($ci_max[8] - $lij[8]);
        $ci_lij_temp = $ci_new / $lij[8];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        } 
        array_push($ci_lij, $ci_lij_temp);

        $ci_lij_max = max($ci_lij);
        $ci_lij_avg = array_sum($ci_lij)/count($ci_lij);

        $wpi = sqrt((pow($ci_lij_max,2) - pow($ci_lij_avg,2)/2));
        
        return $wpi;
    }

    private function status($wpi){
        
    }

}