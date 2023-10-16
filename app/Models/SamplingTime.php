<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamplingTime extends Model
{
    use HasFactory;

    protected $guarded=[];

    function quality(){
        return $this->hasMany(Quality::class)->with('monitoring_point');
    }

    function waterIndex() {
        return $this->hasOne(WaterIndex::class)->with('water_index');
    }
}
