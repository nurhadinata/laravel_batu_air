<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSamplingTimeRequest;
use App\Http\Requests\UpdateSamplingTimeRequest;
use App\Models\SamplingTime;
use App\Models\WaterIdx;
use Illuminate\Http\Request;

class SamplingTimeController extends Controller
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
            'sampling_time' => SamplingTime::orderBy('time', 'DESC')->with('quality')->get()
        ];
        return view('sampling_time', $data);
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
     * @param  \App\Http\Requests\StoreSamplingTimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSamplingTimeRequest $request)
    {
        $this->validate($request,[
            'time' => 'required',
            'quarter' => 'required',
        ]);
        if (SamplingTime::whereYear('time', explode("-",$request->time)[0])->where('quarter', $request->quarter)->get()->isEmpty()) {
            SamplingTime::create([
                'time' => $request->time,
                'quarter' => $request->quarter
            ]);
    
            $samplingId = SamplingTime::where('time', $request->time)
            ->where('quarter',$request->quarter)->value('id');
    
            WaterIdx::create([
                'sampling_time_id' => $samplingId,
                'wqi' => 0.00,
                'wpi' => 0.00
            ]); 
    
            $data = [
                'sampling_time' => SamplingTime::orderBy('time', 'DESC')->get()
            ];
            return redirect()->route('admin.waktu-sampling', $data)
                            ->with('message','Input data sukses');
        } else {
            $data = [
                'sampling_time' => SamplingTime::orderBy('time', 'DESC')->get()
            ];
            return redirect()->route('admin.waktu-sampling', $data)
                            ->with('error','Input data gagal, tahap '.$request->quarter.' pada tahun '.explode("-",$request->time)[0].' sudah tersedia!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SamplingTime  $samplingTime
     * @return \Illuminate\Http\Response
     */
    public function show(SamplingTime $samplingTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SamplingTime  $samplingTime
     * @return \Illuminate\Http\Response
     */
    public function edit(SamplingTime $samplingTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSamplingTimeRequest  $request
     * @param  \App\Models\SamplingTime  $samplingTime
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSamplingTimeRequest $request)
    {
        $this->validate($request,[
            'time' => 'required',
            'quarter' => 'required',
        ]);

        $samplingTime = SamplingTime::find($request->id);
        $samplingTime->update([
            'time' => $request->time,
            'quarter' => $request->quarter
        ]);

        $data = [
            'sampling_time' => SamplingTime::orderBy('time', 'DESC')->get()
        ];
        return redirect()->route('admin.waktu-sampling', $data)
                        ->with('message','Update data sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SamplingTime  $samplingTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        SamplingTime::find($request->id)->delete();
        
        $data = [
            'sampling_time' => SamplingTime::orderBy('time', 'DESC')->get()
        ];
        return redirect()->route('admin.waktu-sampling', $data)
                        ->with('message','Hapus data sukses');
    }
}
