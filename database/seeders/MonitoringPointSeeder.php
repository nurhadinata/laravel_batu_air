<?php

namespace Database\Seeders;

use App\Models\MonitoringPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonitoringPointSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        MonitoringPoint::create([
            'monitoring_point' => 'Mata Air Arboretum Sumber Brantas',
            'desa' => 'Sumber Brantas',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.758521,
            'latitude' => 112.526074
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Sumber Mata Air Gemulo',
            'desa' => 'Punten',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.838832,
            'latitude' => 112.523124
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Sidomulyo 1',
            'desa' => 'Sidomulyo',
            'kecamatan' => 'Batu',
            'longitude' => -7.837449,
            'latitude' => 112.523776
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Sidomulyo 2',
            'desa' => 'Sidomulyo',
            'kecamatan' => 'Batu',
            'longitude' => -7.823533,
            'latitude' => 112.523112
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Jembatan Kekep',
            'desa' => 'Tulungrejo',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.814641,
            'latitude' => 112.522121
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Coban Talun',
            'desa' => 'Tulungrejo',
            'kecamatan' => 'Bumiaji',
            'longitude' => -7.805180,
            'latitude' => 112.517247
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Jembatan Metro',
            'desa' => 'Kepanjen',
            'kecamatan' => 'Kepanjen',
            'longitude' => -7.949737,
            'latitude' => 112.600544
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Temas',
            'desa' => 'Temas',
            'kecamatan' => 'Batu',
            'longitude' => -7.882276,
            'latitude' => 112.528925
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Torongrejo',
            'desa' => 'Torongrejo',
            'kecamatan' => 'Junrejo',
            'longitude' => -7.875748,
            'latitude' => 112.551655
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Desa Pendem',
            'desa' => 'Pendem',
            'kecamatan' => 'Junrejo',
            'longitude' => -7.899656,
            'latitude' => 112.572835
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Dadap Rejo',
            'desa' => 'Dadaprejo',
            'kecamatan' => 'Junrejo',
            'longitude' => -7.906067,
            'latitude' => 112.573377
        ]);

        MonitoringPoint::create([
            'monitoring_point' => 'Brantas Punden',
            'desa' => 'Dadaprejo',
            'kecamatan' => 'Junrejo',
            'longitude' => -7.898218,
            'latitude' => 112.572649
        ]);
    }
}
