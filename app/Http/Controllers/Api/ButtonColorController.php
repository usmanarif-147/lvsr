<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Button\UpdateButtonColorRequest;
use App\Http\Resources\Api\ButtonResource;
use App\Models\ButtonColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ButtonColorController extends Controller
{
    public function allButtonColors()
    {
        $buttonColors = ButtonColor::all();
        $userButton = DB::table('user_button')
            ->select(
                'button_colors.id',
                'button_colors.color_code'
            )
            ->join('button_colors', 'button_colors.id', 'user_button.button_color_id')
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        foreach ($buttonColors as $btnColor) {
            $btnColor['id'] =  $btnColor->id;
            $btnColor['name'] =  $btnColor->name;
            $btnColor['color_code'] =  $btnColor->color_code;
            $btnColor['type'] =  $btnColor->type == 2 ? 'pro' : 'free';
            $btnColor['is_selected'] =  $btnColor->id == $userButton[0]->id ? 1 : 0;
        }

        return response()->json(['buttonColors' => ButtonResource::collection($buttonColors)]);
    }

    public function updateButtonColor(UpdateButtonColorRequest $request)
    {
        $color = ButtonColor::where('id', $request->btn_color_id)->first();
        if (!$color) {
            return response()->json(['message' => 'Button Color not Found']);
        }

        // Check Color Already Selected
        $userButton = DB::table('user_button')
            ->where('button_color_id', $request->btn_color_id)
            ->where('user_id', auth()->id())
            ->first();
        if ($userButton) {
            return response()->json(['message' => 'Button Color Already Selected']);
        }

        // Check Color Is Pro
        if ($color->type == 2 && !auth()->user()->is_subscribed) {
            return response()->json(['message' => 'Please subscribe before select this Button color']);
        }

        // Update User Button Color
        DB::table('user_button')->where('user_id', auth()->id())
            ->update([
                'button_color_id' => $color->id
            ]);

        return response()->json(['message' => 'Button Color is Updated Successfully']);
    }
}
