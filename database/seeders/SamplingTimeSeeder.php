<?php

namespace Database\Seeders;

use App\Models\SamplingTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SamplingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        SamplingTime::create([
            'time' => date_create('2021-07-01'),
            'quarter' => 2
        ]);
        SamplingTime::create([
            'time' => date_create('2021-01-01'),
            'quarter' => 1
        ]);
        SamplingTime::create([
            'time' => date_create('2022-02-01'),
            'quarter' => 1
        ]);
        SamplingTime::create([
            'time' => date_create('2022-06-01'),
            'quarter' => 2
        ]);
    }
}
