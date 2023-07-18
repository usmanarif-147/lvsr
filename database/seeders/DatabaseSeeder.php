<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminTableSeeder::class,
            BackgroundColorSeeder::class,
            ButtonColorSeeder::class,
            FontStyleSeeder::class,
            UserTableSeeder::class,
            LinkSeeder::class,
            PlatformSeeder::class
        ]);
    }
}
