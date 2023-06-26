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
            'username' => 'usman',
            'email' => 'usman@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 1,
            'is_verified' => 1
        ]);
    }
}
