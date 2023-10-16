<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use App\Models\WaterIdx;
use Illuminate\Http\Request;

class QualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Quality::all();
    }

    public function detail() {
        return 'detail kualitas';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function show(Quality $quality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function edit(Quality $quality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $waterIndex = WaterIdx::find($id);
        $samplingId = $waterIndex->sampling_time_id;
        // Getting values from the blade template form
        $wqi = $this->qualityIndex($samplingId);
        $wpi = $this->polutionIndex($samplingId);
        $status = $this->status($wpi);

        $waterIndex->wqi =  $wqi;
        $waterIndex->wpi = $wpi;
        $waterIndex->status = $status;
        $waterIndex->save();
 
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quality  $quality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quality $quality)
    {
        //
    }

    private function qualityIndex($id){
        $request = Quality::where('sampling_time_id',$id)->get();
        $wqi = 0;
        $variable = array("temperature"=>false, "ph"=>false, "tss"=>false, "do"=>false, "bod"=>false, 
                    "cod"=>false, "total_fosfat"=>false, "fecal_coliform"=>false, "total_coliform"=>false);
        $f1 = $f2 = $f3 = $tesCount = $tesTotal = $varCount = $nse = $excursion = $totalExcursion = 0;
        $varTotal = 9;
        $sTemperatureLow = 22;
        $sTemperatureHigh = 28;
        $sPhLow = 6;
        $sPhHigh = 9;
        $sTss = 50;
        $sDo = 4;
        $sBod = 3;
        $sCod = 25;
        $sTotalFosfat = 0.2;
        $sFecalColiform = 1000;
        $sTotalColiform = 5000;

        foreach($request as $request){
            $tesTotal=$tesTotal+9;
            if ($request->temperature > 0){
                if ($request->temperature < $sTemperatureLow){
                    $variable['temperature']=true;
                    $tesCount++;
                    $excursion = ($sTemperatureLow/$request->temperature)-1;
                    $totalExcursion = $totalExcursion + $excursion;
                }elseif($request->temperature > $sTemperatureHigh){
                    $variable['temperature']=true;
                    $tesCount++;
                    $excursion = ($request->temperature/$sTemperatureHigh)-1;
                    $totalExcursion = $totalExcursion + $excursion;
                }
            }
            if($request->ph > 0){
                if ($request->ph < $sPhLow){
                    $variable['ph']=true;
                    $tesCount++;
                    $excursion = ($sPhLow/$request->ph)-1;
                    $totalExcursion = $totalExcursion + $excursion;
                }elseif($request->ph > $sPhHigh){
                    $variable['ph']=true;
                    $tesCount++;
                    $excursion = ($request->ph/$sPhHigh)-1;
                    $totalExcursion = $totalExcursion + $excursion;
                }
            }

            if ($request->tss > $sTss){
                $variable['tss']=true;
                $tesCount++;
                $excursion = ($request->tss/$sTss)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }

            if ($request->do < $sDo && $request->do>0){
                $variable['do']=true;
                $tesCount++;
                $excursion = ($sDo/$request->do)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }

            if ($request->bod > $sBod){
                $variable['bod']=true;
                $tesCount++;
                $excursion = ($request->bod/$sBod)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }

            if ($request->cod > $sCod){
                $variable['cod']=true;
                $tesCount++;
                $excursion = ($request->cod/$sCod)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }

            if ($request->total_fosfat > $sTotalFosfat){
                $variable['total_fosfat']=true;
                $tesCount++;
                $excursion = ($request->total_fosfat/$sTotalFosfat)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }

            if ($request->fecal_coliform > $sFecalColiform){
                $variable['fecal_coliform']=true;
                $tesCount++;
                $excursion = ($request->fecal_coliform/$sFecalColiform)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }

            if ($request->total_coliform > $sTotalColiform){
                $variable['total_coliform']=true;
                $tesCount++;
                $excursion = ($request->total_coliform/$sTotalColiform)-1;
                $totalExcursion = $totalExcursion + $excursion;
            }
        }

        foreach($variable as $key => $value){
            if($value){
                $varCount++;
            }
        }

        $nse = $totalExcursion/$tesTotal;
        $f1 = $varCount/$varTotal*100;
        $f2 = $tesCount/$tesTotal*100;
        $f3 = $nse/((0.02*$nse)+0.01);

        $wqi = 100 - sqrt((($f1*$f1)+($f2*$f2)+($f3*$f3))/1.732);

        return $wqi;    
    }

    private function polutionIndex($id){
        $quality = Quality::where('sampling_time_id',$id)->get();
        $ci_max = array ("temperature" => 0, "ph" => 0, "tss" => 0, "do" => 0, "bod" => 0, "cod" => 0, "total_fosfat" => 0, "fecal_coliform" => 0, "total_coliform" => 0);
        $lij = array ("temperature" => 25, "ph" => 7, "tss" => 50, "do" => 4, "bod" => 3, "cod" => 25, "total_fosfat" => 0.2, "fecal_coliform" => 1000, "total_coliform" => 5000);
        $ci_lij = array("temperature" => 0, "ph" => 0, "tss" => 0, "do" => 0, "bod" => 0, "cod" => 0, "total_fosfat" => 0, "fecal_coliform" => 0, "total_coliform" => 0);
        $wpi = array();
        $i = 0;

        foreach($quality as $request){
            if($ci_max['temperature']<$request->temperature){
                $ci_max['temperature'] = $request->temperature;
            }

            if($ci_max['ph']<$request->ph){
                $ci_max['ph'] = $request->ph;
            }

            if($ci_max['tss']<$request->tss){
                $ci_max['tss'] = $request->tss;
            }

            if($ci_max['do']<$request->do){
                $ci_max['do'] = $request->do;
            }

            if($ci_max['bod']<$request->bod){
                $ci_max['bod'] = $request->bod;
            }

            if($ci_max['cod']<$request->cod){
                $ci_max['cod'] = $request->cod;
            }

            if($ci_max['total_fosfat']<$request->total_fosfat){
                $ci_max['total_fosfat'] = $request->total_fosfat;
            }

            if($ci_max['fecal_coliform']<$request->fecal_coliform){
                $ci_max['fecal_coliform'] = $request->fecal_coliform;
            }

            if($ci_max['total_coliform']<$request->total_coliform){
                $ci_max['total_coliform'] = $request->total_coliform;
            }
        }
        foreach($quality as $request){
            $ci_temp = ($ci_max['temperature'] - $request->temperature)/($ci_max['temperature'] - $lij['temperature']);
            $ci_lij_temp = $ci_temp / $lij['temperature'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['temperature'] = $ci_lij_temp;

            $ci_temp = ($ci_max['ph'] - $request->ph)/($ci_max['ph'] - $lij['ph']);
            $ci_lij_temp = $ci_temp / $lij['ph'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['ph'] = $ci_lij_temp;

            $ci_temp = ($ci_max['tss'] - $request->tss)/($ci_max['tss'] - $lij['tss']);
            $ci_lij_temp = $ci_temp / $lij['tss'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['tss'] = $ci_lij_temp;

            $ci_temp = ($ci_max['do'] - $request->do)/($ci_max['do'] - $lij['do']);
            $ci_lij_temp = $ci_temp / $lij['do'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['do'] = $ci_lij_temp;

            $ci_temp = ($ci_max['bod'] - $request->bod)/($ci_max['bod'] - $lij['bod']);
            $ci_lij_temp = $ci_temp / $lij['bod'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['bod'] = $ci_lij_temp;

            $ci_temp = ($ci_max['cod'] - $request->cod)/($ci_max['cod'] - $lij['cod']);
            $ci_lij_temp = $ci_temp / $lij['cod'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['cod'] = $ci_lij_temp;

            $ci_temp = ($ci_max['total_fosfat'] - $request->total_fosfat)/($ci_max['total_fosfat'] - $lij['total_fosfat']);
            $ci_lij_temp = $ci_temp / $lij['total_fosfat'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['total_fosfat'] = $ci_lij_temp;

            $ci_temp = ($ci_max['fecal_coliform'] - $request->fecal_coliform)/($ci_max['fecal_coliform'] - $lij['fecal_coliform']);
            $ci_lij_temp = $ci_temp / $lij['fecal_coliform'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['fecal_coliform'] = $ci_lij_temp;

            $ci_temp = ($ci_max['total_coliform'] - $request->total_coliform)/($ci_max['total_coliform'] - $lij['total_coliform']);
            $ci_lij_temp = $ci_temp / $lij['total_coliform'];
            if ($ci_lij_temp > 1) {
                $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
            }
            $ci_lij['total_coliform'] = $ci_lij_temp;

            $ci_lij_max = max($ci_lij);
            $ci_lij_avg = array_sum($ci_lij)/count($ci_lij);

            $ci_lij_max = max($ci_lij);
            $ci_lij_avg = array_sum($ci_lij)/count($ci_lij);

            $wpi_temp = sqrt((pow($ci_lij_max,2) - pow($ci_lij_avg,2)/2));

            array_push($wpi, $wpi_temp);
            
        }

        $wpi_avg = array_sum($wpi)/count($wpi);
        
        return $wpi_avg;
    }

    private function status($wpi){
        if($wpi<1){
            return "bersih";
        }else if($wpi<2){
            return "tercemar ringan";
        }else if($wpi<4){
            return "tercemar sedang";
        }else{
            return "tercemar berat";
        }
    }
}
