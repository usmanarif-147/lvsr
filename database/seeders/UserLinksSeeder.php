<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLinksSeeder extends Seeder
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
                'label' => 'twitter',
                'url' => 'www.twitter.com',
            ],
            [
                'label' => 'facebook',
                'url' => 'www.facebook.com',
            ],
            [
                'label' => 'linkedin',
                'url' => 'www.linkedin.com',
            ],
            [
                'label' => 'horizam',
                'url' => 'www.horizam.com',
            ],
            [
                'label' => 'instagram',
                'url' => 'www.instagram.com',
            ],
        ];

        $users = User::pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $range = rand(0, 4);
            for ($j = 0; $j < $range; $j++) {
                $user_id = $users[array_rand($users)];
                $links[$j]['user_id'] = $user_id;
                UserLink::create($links[$j]);
            }
        }
    }
}
