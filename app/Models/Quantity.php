<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{

    public $table = "quantities";
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['status'];

    public function monitoring_point()
    {
        return $this->belongsTo(MonitoringPoint::class);
    }

    public function getStatusAttribute()
    {
        $siaga1 = 0;
        $siaga2 = 0;
        $siaga3 = 0;
        switch ($this->id) {
            case 1:
                $siaga1 = 40;
                $siaga2 = 35;
                $siaga3 = 32;
                $normal = 30;
                break;
            case 2:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 3:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 4:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 5:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 6:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 7:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 8:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 9:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 10:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 11:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            case 12:
                $siaga1 = 15;
                $siaga2 = 10;
                $siaga3 = 7;
                $normal = 5;
                break;
            default:
                $siaga1 = 40;
                $siaga2 = 35;
                $siaga3 = 32;
                $normal = 30;
                break;
        }

        if ($this->height_above_water > $siaga1) {
            return "Siaga 1";
        } else if ($this->height_above_water > $siaga2) {
            return "Siaga 2";
        } else if ($this->height_above_water > $siaga3) {
            return "Siaga 3";
        } else {
            return "Normal";
        }
    }
}
