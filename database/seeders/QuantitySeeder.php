<?php

namespace Database\Seeders;

use App\Models\Quantity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuantitySeeder extends Seeder {
    public function run() {
        Quantity::create([
            'monitoring_point_id' => 4,
            'height_above_water' => 12,
            'current_speed' => 10,

        ]);

        Quantity::create([
            'monitoring_point_id' => 5,
            'height_above_water' => 20,
            'current_speed' => 13,

        ]);

        Quantity::create([
            'monitoring_point_id' => 6,
            'height_above_water' => 5,
            'current_speed' => 2,

        ]);

        Quantity::create([
            'monitoring_point_id' => 7,
            'height_above_water' => 32,
            'current_speed' => 2,

        ]);

        Quantity::create([
            'monitoring_point_id' => 8,
            'height_above_water' => 0.3,
            'current_speed' => 2,

        ]);

        Quantity::create([
            'monitoring_point_id' => 9,
            'height_above_water' => 50,
            'current_speed' => 22,

        ]);

        Quantity::create([
            'monitoring_point_id' => 10,
            'height_above_water' => 12,
            'current_speed' => 0,

        ]);

        Quantity::create([
            'monitoring_point_id' => 11,
            'height_above_water' => 30,
            'current_speed' => 2,

        ]);

        Quantity::create([
            'monitoring_point_id' => 12,
            'height_above_water' => 27,
            'current_speed' => 12,

        ]);

        Quantity::create([
            'monitoring_point_id' => 13,
            'height_above_water' => 5,
            'current_speed' => 9,

        ]);

        Quantity::create([
            'monitoring_point_id' => 14,
            'height_above_water' => 45,
            'current_speed' => 49,

        ]);

        Quantity::create([
            'monitoring_point_id' => 15,
            'height_above_water' => 3,
            'current_speed' => 3,

        ]);
       
    }
}
