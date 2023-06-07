<?php

namespace Database\Seeders;

use App\Models\FontStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FontStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fontStyles = [
            [
                'name' => 'Montez',
                'font_style' => 'Montez',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Josefin Sans',
                'font_style' => 'Josefin Sans',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Lobster',
                'font_style' => 'Lobster',
                'type' => 2,
                'status' => 1,
            ],
        ];

        foreach ($fontStyles as $fontStyle) {
            FontStyle::create($fontStyle);
        }
    }
}
