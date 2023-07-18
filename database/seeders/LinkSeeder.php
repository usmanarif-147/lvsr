<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'label'  =>  'imdb',
                'icon' => 'uploads/1680681100.png',
                'status' => 1
            ],
            [
                'label'  =>  'paypal',
                'icon' => 'uploads/1680683316.png',
                'status' => 1
            ],
            [
                'label'  =>  'whatsapp',
                'icon' => 'uploads/1680683731.png',
                'status' => 1
            ],
            [
                'label'  =>  'gmail',
                'icon' => 'uploads/1680683764.png',
                'status' => 1
            ],
            [
                'label'  =>  'youtube',
                'icon' => 'uploads/1680683931.png',
                'status' => 1
            ],
            [
                'label'  =>  'linkedin',
                'icon' => 'uploads/1680684006.png',
                'status' => 1
            ],
            [
                'label'  =>  'instagram',
                'icon' => 'uploads/1680684051.png',
                'status' => 1
            ],
            [
                'label'  =>  'twitter',
                'icon' => 'uploads/1680684271.png',
                'status' => 1
            ],
        ];

        foreach ($links as $link) {
            Link::create($link);
        }
    }
}
