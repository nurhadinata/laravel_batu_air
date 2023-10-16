<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MonitoringPoint;

class Image extends Model
{
    use HasFactory;

    public function monitoring_point(){
        return $this->belongsTo(MonitoringPoint::class);
    }
}
