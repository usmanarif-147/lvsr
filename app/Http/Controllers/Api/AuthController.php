<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ExtraDetailRequest;
use App\Http\Requests\Api\Auth\ForgotPasswordRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RecoverAccountRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Mail\ForgotPasswordMail;
use App\Models\BackgroundColor;
use App\Models\ButtonColor;
use App\Models\FontStyle;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    /**
     * Registration
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_verified' => 1,
            'status' => 1
        ]);

        // default background color
        $backgroundColor = BackgroundColor::where('type', 1)->where('status', 1)->first();
        DB::table('user_background')->insert([
            'user_id' => $user->id,
            'background_color_id' => $backgroundColor->id,
        ]);

        // default button color
        $buttonColor = ButtonColor::where('type', 1)->where('status', 1)->first();
        DB::table('user_button')->insert([
            'user_id' => $user->id,
            'button_color_id' => $buttonColor->id,
        ]);

        // default font style
        $fontStyle = FontStyle::where('type', 1)->where('status', 1)->first();
        DB::table('user_font')->insert([
            'user_id' => $user->id,
            'font_style_id' => $fontStyle->id,
        ]);

        // default template
        $template = Template::where('type', 1)->where('status', 1)->first();
        DB::table('user_templates')->insert([
            'user_id' => $user->id,
            'template_id' => $template->id,
        ]);

        $token = $user->createToken(getDeviceId()  ?: $user->email)->plainTextToken;

        return response()->json(
            [
                'message' => 'Account registered successfully',
                'token' => $token,
                // 'user' => new UserResource(User::find($user->id)),
                // 'background_color' => [
                //     'name' => $backgroundColor->name,
                //     'color_code' => $backgroundColor->color_code
                // ],
                // 'button_color' => [
                //     'name' => $buttonColor->name,
                //     'color_code' => $buttonColor->color_code
                // ],
                // 'font_style' => [
                //     'name' => $fontStyle->name,
                //     'font_style' => $fontStyle->font_style
                // ],
            ]
        );
    }

    /**
     * Extra Details
     */
    public function extraDetails(ExtraDetailRequest $request)
    {
        $message = 'You can add Bio and photo later';
        $oldPhoto = auth()->user()->photo;
        $photo = $oldPhoto ? $oldPhoto : null;
        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $photo = 'uploads/' . $imageName;

            if ($oldPhoto) {
                if (Storage::exists('public/' . $oldPhoto)) {
                    Storage::delete('public/' . $oldPhoto);
                }
            }
        }

        User::where('id', auth()->id())->update([
            'bio' => $request->bio,
            'photo' => $photo
        ]);

        if ($photo) {
            $message = 'Photo is added to your profile';
        }
        if ($request->bio) {
            $message = 'Bio information is added to your profile';
        }
        if ($photo && $request->bio) {
            $message = 'Photo and Bio information is added to your profile';
        }

        return response()->json(
            [
                'message' => $message,
                'user' => new UserResource(User::find(auth()->id())),
            ]
        );
    }


    /**
     * Login
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email is not registered']);
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Password is incorrect']);
        }

        $token = $user->createToken(getDeviceId()  ?: $user->email)->plainTextToken;
        return response()->json(
            [
                'message' => 'Logged in successfully',
                'user' => new UserResource($user),
                'token' => $token
            ]
        );
    }

    /**
     * Forgot Password
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', strtolower(trim($request->email)))->first();

        if (!$user) {
            return response()->json(['message' => 'Email is not registered']);
        }

        $this->sendOtp($user->email);
        return response()->json(
            ['message' => 'Otp has been sent to email. Otp will expire after 5 minutes'],
        );
    }

    /**
     * Send Otp
     */
    private function sendOtp($email)
    {
        $email = trim($email);
        $otp = rand(1111, 9999);

        DB::table('password_resets')->where('email', $email)->delete();

        DB::table('password_resets')->insert([
            'email' =>  $email,
            'token' => $otp,
            'created_at' => now(),
        ]);

        Mail::to($email)->send(new ForgotPasswordMail($otp));
    }

    /**
     * Reset Password
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $email = strtolower(trim($request->email));
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email is not registered']);
        }

        $verifyOtp = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$verifyOtp) {
            return response()->json(['message' => 'Otp is not valid']);
        }

        if (now()->diffInMinutes($verifyOtp->created_at) > 5) {
            $verifyOtp = DB::table('password_resets')
                ->where('email', $email)
                ->where('token', $request->otp)
                ->delete();
            return response()->json(['message' => 'Otp expired']);
        }

        DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->delete();

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken(getDeviceId()  ?: $user->email)->plainTextToken;

        return response()->json(['message' => 'Password set successfully', 'token' => $token]);
    }

    /**
     * Recove Account
     */
    public function recoverAccount(RecoverAccountRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email is not registered']);
        }

        if ($user->status == 0) {
            $updated = User::where('email', $request->email)->update(
                [
                    'status' => 1,
                    'deactivated_at' => null,
                ]
            );
            if ($updated) {
                return response()->json(['message' => 'Account recovered successfully']);
            }
        } else {
            return response()->json(['message' => 'Account is already activated']);
        }
        return response()->json(['message' => 'Something went wrong']);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged Out Successfully']);
    }
}
