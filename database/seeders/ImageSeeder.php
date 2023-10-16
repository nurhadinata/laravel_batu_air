<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'monitoring_point_id' => 1,
            'link' => '/image/sungai-brantas/sumber-brantas-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 2,
            'link' => '/image/sungai-brantas/coban-talun-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 3,
            'link' => '/image/sungai-brantas/sungai-kekep-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 4,
            'link' => '/image/sungai-brantas/mata-air-gemulo-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 5,
            'link' => '/image/sungai-brantas/sungai-jembatan-sidomulyo-1-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 6,
            'link' => '/image/sungai-brantas/sungai-jembatan-sidomulyo-2-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 7,
            'link' => '/image/sungai-brantas/sungai-jembatan-metro-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 8,
            'link' => '/image/sungai-brantas/sungai-punden-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 9,
            'link' => '/image/sungai-brantas/sungai-temas-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 10,
            'link' => '/image/sungai-brantas/sungai-arung-jeram-torongrejo-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 11,
            'link' => '/image/sungai-brantas/sungai-pendem-1.jpg'
        ]);

        Image::create([
            'monitoring_point_id' => 12,
            'link' => '/image/sungai-brantas/sungai-dadaprejo-1.jpg'
        ]);
    }
}
