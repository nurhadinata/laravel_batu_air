<?php

namespace Database\Seeders;

use App\Models\MonitoringPoint;
use App\Models\Quality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MonitoringPointSeeder::class);
        $this->call(SamplingTimeSeeder::class);
        $this->call(QualitySeeder::class);
        $this->call(QuantitySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(WaterIdxSeeder::class);
    }
}
