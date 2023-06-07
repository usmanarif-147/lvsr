<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Background\UpdateBackgroundRequest;
use App\Http\Resources\Api\BackgroundResource;
use App\Models\BackgroundColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackgroundColorController extends Controller
{
    public function allBackgroundColors()
    {
        $backgroundColors = BackgroundColor::all();
        $userBackground = DB::table('user_background')
            ->select(
                'background_colors.id',
                'background_colors.color_code'
            )
            ->join('background_colors', 'background_colors.id', 'user_background.background_color_id')
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        foreach ($backgroundColors as $bgColor) {
            $bgColor['id'] =  $bgColor->id;
            $bgColor['name'] =  $bgColor->name;
            $bgColor['color_code'] =  $bgColor->color_code;
            $bgColor['type'] =  $bgColor->type == 2 ? 'pro' : 'free';
            $bgColor['is_selected'] =  $bgColor->id == $userBackground[0]->id ? 1 : 0;
        }

        return response()->json(['backgroundColors' => BackgroundResource::collection($backgroundColors)]);
    }

    public function updateBackgroundColor(UpdateBackgroundRequest $request)
    {
        $color = BackgroundColor::where('id', $request->bg_color_id)->first();
        if (!$color) {
            return response()->json(['message' => 'Background Color not Found']);
        }

        // Check Color Already Selected
        $userBackground = DB::table('user_background')
            ->where('background_color_id', $request->bg_color_id)
            ->where('user_id', auth()->id())
            ->first();
        if ($userBackground) {
            return response()->json(['message' => 'Background Color Already Selected']);
        }

        // Check Color Is Pro
        if ($color->type == 2 && !auth()->user()->is_subscribed) {
            return response()->json(['message' => 'Please subscribe before select this background color']);
        }

        // Update User Background Color
        DB::table('user_background')->where('user_id', auth()->id())
            ->update([
                'background_color_id' => $color->id
            ]);

        return response()->json(['message' => 'Background Color is Updated Successfully']);
    }
}
