<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MonitoringPoint;
use App\Models\User;

class Quality extends Model
{
    public $table ="qualities";
    use HasFactory;

    public function monitoring_point(){
        return $this->belongsTo(MonitoringPoint::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function sampling_time(){
        return $this->belongsTo(SamplingTime::class);
    }

    protected $fillable = [
        'monitoring_point_id',
        'sampling_time_id',
        'users_id',
        'wqi',
        'wpi',
        'status', 
        'temperature', 
        'ph', 
        'dhl', 
        'tds', 
        'tss', 
        'do', 
        'bod', 
        'cod', 
        'no_2',
        'no_3',
        'nh_2',
        'clorin',
        'total_fosfat',
        'fenol',
        'oil',
        'detergent',
        'fecal_coliform',
        'total_coliform',
        'cyanide',
        'h2s'
     ];
}
