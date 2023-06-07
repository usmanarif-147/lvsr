<?php

namespace Database\Seeders;

use App\Models\BackgroundColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BackgroundColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backgroundColors = [
            [
                'name' => 'Coral Tree',
                'color_code' => '#AB6969',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Morning Glory',
                'color_code' => '#9CD6DE',
                'type' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Mint Julep',
                'color_code' => '#EFEAB9',
                'type' => 2,
                'status' => 1,
            ],
        ];

        foreach ($backgroundColors as $bgColor) {
            BackgroundColor::create($bgColor);
        }
    }
}
