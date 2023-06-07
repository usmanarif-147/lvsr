<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Resources\Api\PlatformResource;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Resources\Api\UserResource;
use App\Models\BackgroundColor;
use App\Models\ButtonColor;
use App\Models\FontStyle;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $platforms = DB::table('user_platform')
            ->select(
                'platforms.id',
                'platforms.title',
                'platforms.icon',
                'platforms.base_url',
                'user_platform.created_at',
                'user_platform.path',
                'user_platform.label',
                'user_platform.platform_order',
            )
            ->join('platforms', 'platforms.id', 'user_platform.platform_id')
            ->where('user_id', auth()->id())
            ->orderBy(('user_platform.platform_order'))
            ->get();


        // default background color
        $backgroundColor = BackgroundColor::select(
            'background_colors.name',
            'background_colors.color_code',
            'background_colors.type',
        )
            ->join('user_background', 'user_background.background_color_id', 'background_colors.id')
            ->join('users', 'users.id', 'user_background.user_id')
            ->where('user_background.user_id', auth()->id())
            ->first();

        // default button color
        $buttonColor = ButtonColor::select(
            'button_colors.name',
            'button_colors.color_code',
            'button_colors.type',
        )
            ->join('user_button', 'user_button.button_color_id', 'button_colors.id')
            ->join('users', 'users.id', 'user_button.user_id')
            ->where('user_button.user_id', auth()->id())
            ->first();

        // default font style
        $fontStyle = FontStyle::select(
            'font_styles.name',
            'font_styles.font_style',
            'font_styles.type',
        )
            ->join('user_font', 'user_font.font_style_id', 'font_styles.id')
            ->join('users', 'users.id', 'user_font.user_id')
            ->where('user_font.user_id', auth()->id())
            ->first();

        return response()->json(
            [
                'profile' => new UserResource(auth()->user()),
                'background_color' => [
                    'name' => $backgroundColor->name,
                    'color_code' => $backgroundColor->color_code,
                    'type' => $backgroundColor->type == 1 ? 'Free' : 'Pro'
                ],
                'button_color' => [
                    'name' => $buttonColor->name,
                    'color_code' => $buttonColor->color_code,
                    'type' => $buttonColor->type == 1 ? 'Free' : 'Pro'
                ],
                'font_style' => [
                    'name' => $fontStyle->name,
                    'font_style' => $fontStyle->font_style,
                    'type' => $fontStyle->type == 1 ? 'Free' : 'Pro'
                ],
                'platforms' => PlatformResource::collection($platforms)
            ]
        );
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $cover_photo = auth()->user()->cover_photo;
            $photo = auth()->user()->photo;

            if ($request->hasFile('cover_photo')) {
                $image = $request->cover_photo;
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/uploads/coverPhotos', $imageName);
                $cover_photo = 'uploads/coverPhotos/' . $imageName;
                if (auth()->user()->cover_photo) {
                    if (Storage::exists('public/' . auth()->user()->cover_photo)) {
                        Storage::delete('public/' . auth()->user()->cover_photo);
                    }
                }
            }
            if ($request->hasFile('photo')) {
                $image = $request->photo;
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('public/uploads/photos', $imageName);
                $photo = 'uploads/photos/' . $imageName;
                if (auth()->user()->photo) {
                    if (Storage::exists('public/' . auth()->user()->photo)) {
                        Storage::delete('public/' . auth()->user()->photo);
                    }
                }
            }
            $isUpdated = User::where('id', auth()->id())->update([
                'username' => $request->username,
                'bio' => $request->bio,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'private' => $request->private,
                'name' => $request->name,
                'cover_photo' => $cover_photo,
                'photo' => $photo,
                'address' => $request->address,
                'job_title' => $request->job_title,
                'company' => $request->company,
                'phone' => $request->phone,
            ]);

            if (!$isUpdated) {
                return response()->json(['message' => 'Sorry, Pofile not updated']);
            }

            $user = User::where('id', auth()->id())->get()->first();

            return response()->json(['message' => 'Pofile updated successfully', 'data' => $user]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    public function userDirect()
    {
        $user = auth()->user();

        if ($user->user_direct) {
            User::where('id', $user->id)
                ->update(
                    [
                        'user_direct' => 0
                    ]
                );

            $user = User::find(auth()->id());

            return response()->json(['message' => 'All platforms are set to public', 'profile' => new ProfileResource($user)]);
        }

        User::where('id', auth()->id())
            ->update(
                [
                    'user_direct' => 1
                ]
            );
        $user = User::find(auth()->id());
        return response()->json(['message' => 'Only first platform on top set to public', 'profile' => new ProfileResource($user)]);
    }

    public function privateProfile()
    {

        $status = auth()->user()->private ? 'Public' : 'Private';

        User::where('id', auth()->id())
            ->update(
                [
                    'user_direct' => auth()->user()->user_direct ? 0 : 1
                ]
            );

        return response()->json(['message' => "Profile is set to " . $status, 'data' => auth()->user()]);
    }
}
