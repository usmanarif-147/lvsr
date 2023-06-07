<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'username' => $faker->userName,
            'email' => 'usman@gmail.com',
            'phone' => $faker->phoneNumber,
            'password' => bcrypt('123456'),
        ]);
        // for ($i = 0; $i < 10; $i++) {
        //     User::create([
        //         'username' => $faker->userName,
        //         'email' => 'usman@gmail.com',
        //         'phone' => $faker->phoneNumber,
        //         'password' => bcrypt('123456'),
        //     ]);
        // }
    }
}
