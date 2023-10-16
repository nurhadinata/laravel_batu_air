<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quality;
use App\Models\Quantity;
use App\Models\Image;

class MonitoringPoint extends Model
{
    public $table ="monitoring_points";
    use HasFactory;

    public function quality(){
        return $this->hasMany(Quality::class);
    }

    public function quantity(){
        return $this->hasMany(Quantity::class);
    }

    public function image(){
        return $this->hasMany(Image::class);
    }   
}
