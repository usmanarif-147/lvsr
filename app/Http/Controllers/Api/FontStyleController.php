<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Font\UpdateFontStyleRequest;
use App\Http\Resources\Api\FontResource;
use App\Models\FontStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FontStyleController extends Controller
{
    public function allFontStyles()
    {
        $fontSyles = FontStyle::all();
        $userFont = DB::table('user_font')
            ->select(
                'font_styles.id',
                'font_styles.font_style'
            )
            ->join('font_styles', 'font_styles.id', 'user_font.font_style_id')
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        foreach ($fontSyles as $fnStyle) {
            $fnStyle['id'] =  $fnStyle->id;
            $fnStyle['name'] =  $fnStyle->name;
            $fnStyle['font_style'] =  $fnStyle->font_style;
            $fnStyle['type'] =  $fnStyle->type == 2 ? 'pro' : 'free';
            $fnStyle['is_selected'] =  $fnStyle->id == $userFont[0]->id ? 1 : 0;
        }

        return response()->json(['fontStyles' => FontResource::collection($fontSyles)]);
    }

    public function updateButtonColor(UpdateFontStyleRequest $request)
    {
        $color = FontStyle::where('id', $request->fn_style_id)->first();
        if (!$color) {
            return response()->json(['message' => 'Font Style not Found']);
        }

        // Check Color Already Selected
        $userFont = DB::table('user_font')
            ->where('font_style_id', $request->fn_style_id)
            ->where('user_id', auth()->id())
            ->first();
        if ($userFont) {
            return response()->json(['message' => 'Font Style Already Selected']);
        }

        // Check Color Is Pro
        if ($color->type == 2 && !auth()->user()->is_subscribed) {
            return response()->json(['message' => 'Please subscribe before select this Font Style']);
        }

        // Update User Font Style
        DB::table('user_font')->where('user_id', auth()->id())
            ->update([
                'font_style_id' => $color->id
            ]);

        return response()->json(['message' => 'Font Style is Updated Successfully']);
    }
}
