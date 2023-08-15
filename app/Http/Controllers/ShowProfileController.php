<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowProfileController extends Controller
{
    public function showProfile($data)
    {
        $user = null;
        $user = Card::join('user_cards', 'cards.id', 'user_cards.card_id')
            ->join('users', 'users.id', 'user_cards.user_id')
            ->where('cards.uuid', $data)
            ->first();

        if (!$user) {
            $user = User::where('username', $data)
                ->first();
        }
        if (!$user) {
            return abort(404);
        }

        $userDetails = User::select(
            'users.id as user_id',
            'users.name',
            'users.email',
            'users.username',
            'users.bio',
            'users.phone',
            'users.job_title',
            'users.company',
            'users.photo',
            'users.cover_photo',
            'users.address',
            'button_colors.id as btn_id',
            'button_colors.color_code as btn_color_code',
            'font_styles.id as font_id',
            'font_styles.font_style as fn_style',
            'background_colors.id as bg_id',
            'background_colors.color_code as bg_color_code',
            'templates.id as temp_id',
            'templates.image as temp_image',
        )
            ->join('user_font', 'user_font.user_id', 'users.id')
            ->join('font_styles', 'user_font.font_style_id', 'font_styles.id')
            ->join('user_button', 'user_button.user_id', 'users.id')
            ->join('button_colors', 'user_button.button_color_id', 'button_colors.id')
            ->join('user_background', 'user_background.user_id', 'users.id')
            ->join('background_colors', 'user_background.background_color_id', 'background_colors.id')
            ->join('user_templates', 'user_templates.user_id', 'users.id')
            ->join('templates', 'user_templates.template_id', 'templates.id')
            ->where('users.id', $user->id)
            ->get()
            ->map(function ($user) {
                return [
                    'user_id' => $user->user_id,
                    'name' => $user->name ? $user->name : $user->username,
                    'email' => $user->email ? $user->email : 'N/A',
                    'bio' => $user->bio ? $user->bio : 'N/A',
                    'phone' => $user->phone ? $user->phone : 'N/A',
                    'job_title' => $user->job_title ? $user->job_title : 'N/A',
                    'company' => $user->company ? $user->company : 'N/A',
                    'photo' => $user->photo,
                    'cover_photo' => $user->cover_photo,
                    'address' => $user->address ? $user->address : 'N/A',
                    'btn_id' => $user->btn_id,
                    'btn_color_code' => $user->btn_color_code,
                    'font_id' => $user->font_id,
                    'fn_style' => $user->fn_style,
                    'bg_id' => $user->bg_id,
                    'bg_color_code' => $user->bg_color_code,
                    'temp_id' => $user->temp_id,
                    'temp_image' => $user->temp_image,
                ];
            })
            ->first();

        $userPlatforms = [];
        $platforms = DB::table('user_platforms')
            ->select(
                'platforms.id',
                'platforms.title',
                'platforms.icon',
                'platforms.base_url',
                'user_platforms.created_at',
                'user_platforms.path',
                'user_platforms.label',
                'user_platforms.platform_order',
            )
            ->join('platforms', 'platforms.id', 'user_platforms.platform_id')
            ->where('user_id', $user->id)
            ->orderBy(('user_platforms.platform_order'))
            ->get();

        for ($i = 0; $i < $platforms->count(); $i++) {
            array_push($userPlatforms, $platforms[$i]);
        }

        // $userPlatforms = array_chunk($userPlatforms, 4);

        // dd($userDetails['name']);

        if ($userDetails['temp_id'] == 1) {
            return view('user-profile.temp-one', compact('userDetails', 'userPlatforms'));
        }
        if ($userDetails['temp_id'] == 2) {
            return view('user-profile.temp-two', compact('userDetails', 'userPlatforms'));
        }
        if ($userDetails['temp_id'] == 3) {
            return view('user-profile.temp-three', compact('userDetails', 'userPlatforms'));
        }
        if ($userDetails['temp_id'] == 4) {
            return view('user-profile.temp-four', compact('userDetails', 'userPlatforms'));
        }
        if ($userDetails['temp_id'] == 5) {
            return view('user-profile.temp-five', compact('userDetails', 'userPlatforms'));
        }
        if ($userDetails['temp_id'] == 6) {
            return view('user-profile.temp-six', compact('userDetails', 'userPlatforms'));
        }



        // return view('profile', compact('user', 'userPlatforms'));
    }
}
