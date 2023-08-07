<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Resources\Api\PlatformResource;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Resources\Api\UserResource;
use App\Mail\AskQuestionMail;
use App\Models\BackgroundColor;
use App\Models\ButtonColor;
use App\Models\FontStyle;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'background_colors.id as bg_color_id',
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
            'button_colors.id as bt_color_id',
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
            'font_styles.id as fs_id',
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
                    'id' => $backgroundColor->bg_color_id,
                    'name' => $backgroundColor->name,
                    'color_code' => $backgroundColor->color_code,
                    'type' => $backgroundColor->type == 1 ? 'Free' : 'Pro'
                ],
                'button_color' => [
                    'id' => $buttonColor->bt_color_id,
                    'name' => $buttonColor->name,
                    'color_code' => $buttonColor->color_code,
                    'type' => $buttonColor->type == 1 ? 'Free' : 'Pro'
                ],
                'font_style' => [
                    'id' => $fontStyle->fs_id,
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

    // public function userDirect()
    // {
    //     $user = auth()->user();

    //     if ($user->user_direct) {
    //         User::where('id', $user->id)
    //             ->update(
    //                 [
    //                     'user_direct' => 0
    //                 ]
    //             );

    //         $user = User::find(auth()->id());

    //         return response()->json(['message' => 'All platforms are set to public', 'profile' => new ProfileResource($user)]);
    //     }

    //     User::where('id', auth()->id())
    //         ->update(
    //             [
    //                 'user_direct' => 1
    //             ]
    //         );
    //     $user = User::find(auth()->id());
    //     return response()->json(['message' => 'Only first platform on top set to public', 'profile' => new ProfileResource($user)]);
    // }

    // public function privateProfile()
    // {

    //     $status = auth()->user()->private ? 'Public' : 'Private';

    //     User::where('id', auth()->id())
    //         ->update(
    //             [
    //                 'user_direct' => auth()->user()->user_direct ? 0 : 1
    //             ]
    //         );

    //     return response()->json(['message' => "Profile is set to " . $status, 'data' => auth()->user()]);
    // }

    /**
     * Get User Language
     */
    public function getUserLanguage()
    {
    }

    /**
     * Account Settings
     */
    public function accountSettings(ProfileRequest $request)
    {
        User::where('id', auth()->id())->update($request->validated());

        $user = User::where('id', auth()->id())->get()->first();

        return response()->json([
            'message' => 'Account Information updated Successfully',
            'profile' => $user
        ]);
    }

    /**
     * Change Password
     */
    public function changePassword(ProfileRequest $request)
    {
        $user = User::where('id', auth()->id());
        if (!Hash::check($request->old_password, $user->first()->password)) {
            return response()->json(['message' => 'Your current password is not correct']);
        }

        User::where('id', auth()->id())->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Password Updated successfully',
        ]);
    }

    /**
     * Change Language
     */
    public function changeLanguage(Request $request)
    {
    }

    /**
     * Ask Question
     */
    public function askQuestion(ProfileRequest $request)
    {

        $mailData = [
            'name' => auth()->user()->name ? auth()->user()->name : auth()->user()->username,
            'email' => auth()->user()->email,
            'question' => $request->question
        ];

        Mail::to(env('MAIL_USERNAME'))->send(new AskQuestionMail($mailData));

        return response()->json(['message' => 'Mail Sent Sussessfully']);
    }
}
