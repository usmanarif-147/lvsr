<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platforms = [
            [
                'title'  =>  'imdb',
                'icon' => 'uploads/1680681100.png',
                'status' => 1
            ],
            [
                'title'  =>  'paypal',
                'icon' => 'uploads/1680683316.png',
                'status' => 1
            ],
            [
                'title'  =>  'whatsapp',
                'icon' => 'uploads/1680683731.png',
                'status' => 1
            ],
            [
                'title'  =>  'gmail',
                'icon' => 'uploads/1680683764.png',
                'status' => 1
            ],
            [
                'title'  =>  'youtube',
                'icon' => 'uploads/1680683931.png',
                'status' => 1
            ],
            [
                'title'  =>  'linkedin',
                'icon' => 'uploads/1680684006.png',
                'status' => 1
            ],
            [
                'title'  =>  'instagram',
                'icon' => 'uploads/1680684051.png',
                'status' => 1
            ],
            [
                'title'  =>  'twitter',
                'icon' => 'uploads/1680684271.png',
                'status' => 1
            ],
        ];

        foreach ($platforms as $platform) {
            Platform::create($platform);
        }
    }
}
