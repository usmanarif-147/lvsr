<?php

namespace Database\Seeders;

use App\Models\BackgroundColor;
use App\Models\ButtonColor;
use App\Models\FontStyle;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $users = [
            [
                'username' => 'usman',
                'email' => 'usman@gmail.com',
                'password' => bcrypt('123456'),
                'status' => 1,
                'is_verified' => 1
            ],
            [
                'username' => 'zubair',
                'email' => 'zubair@gmail.com',
                'password' => bcrypt('123456'),
                'status' => 1,
                'is_verified' => 1
            ],
            [
                'username' => 'asif',
                'email' => 'asif@gmail.com',
                'password' => bcrypt('123456'),
                'status' => 1,
                'is_verified' => 1
            ]
        ];

        foreach ($users as $user) {
            $user = User::create($user);

            // default background color
            $backgroundColor = BackgroundColor::where('type', 1)->first();
            DB::table('user_background')->insert([
                'user_id' => $user->id,
                'background_color_id' => $backgroundColor->id,
            ]);

            // default button color
            $buttonColor = ButtonColor::where('type', 1)->first();
            DB::table('user_button')->insert([
                'user_id' => $user->id,
                'button_color_id' => $buttonColor->id,
            ]);

            // default font style
            $fontStyle = FontStyle::where('type', 1)->first();
            DB::table('user_font')->insert([
                'user_id' => $user->id,
                'font_style_id' => $fontStyle->id,
            ]);
        }
    }
}
