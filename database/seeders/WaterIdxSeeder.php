<?php

namespace Database\Seeders;

use App\Models\WaterIdx;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterIdxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        WaterIdx::create([
            'sampling_time_id' => 1,
            'wqi' => 0,
            'wpi' => 0,
            'status' => 'bersih'
        ]);
        WaterIdx::create([
            'sampling_time_id' => 2,
            'wqi' => 0,
            'wpi' => 0,
            'status' => 'bersih'
        ]);
        WaterIdx::create([
            'sampling_time_id' => 3,
            'wqi' => 0,
            'wpi' => 0,
            'status' => 'bersih'
        ]);
        WaterIdx::create([
            'sampling_time_id' => 4,
            'wqi' => 0,
            'wpi' => 0,
            'status' => 'bersih'
        ]);
    }
}
