<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterIdx extends Model
{
    use HasFactory;

    public function sampling_time(){
        return $this->belongsTo(SamplingTime::class);
    }

    protected $fillable = [
        'sampling_time_id',
        'wqi',
        'wpi',
        'status', 
     ];
}

