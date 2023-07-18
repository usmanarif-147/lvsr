<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Platform\AddPlatformRequest;
use App\Http\Requests\Api\Platform\IncrementRequest;
use App\Http\Requests\Api\Platform\PlatformRequest;
use App\Http\Requests\Api\Platform\SwapPlatformRequest;
use App\Http\Resources\Api\PlatformResource;
use App\Models\Platform;
use Exception;
use Illuminate\Support\Facades\DB;

class PlatformController extends Controller
{

    /**
     * Get All Platforms
     */
    public function allPlatforms()
    {
        $platforms = Platform::all();
        $userPlatforms = DB::table('user_platform')
            ->select(
                'user_platform.platform_id',
                'user_platform.total_views',
                'user_platform.path',
                'user_platform.label',
            )
            ->join('platforms', 'platforms.id', 'user_platform.platform_id')
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        foreach ($platforms as $platform) {
            //check platform saved by user
            $userPlatform = $this->checkPlatformSaved($platform->id, $userPlatforms);

            $platform['id'] = $platform->id;
            $platform['title'] = $platform->title;
            $platform['icon'] = $platform->icon;
            $platform['base_url'] = $platform->base_url;
            $platform['placeholder_en'] = $platform->placeholder_en;
            $platform['placeholder_fr'] = $platform->placeholder_fr;
            $platform['placeholder_sp'] = $platform->placeholder_sp;
            $platform['description_en'] = $platform->description_en;
            $platform['description_fr'] = $platform->description_fr;
            $platform['description_sp'] = $platform->description_sp;
            $platform['saved'] =  $userPlatform ? 1 : 0;
            $platform['path'] = $userPlatform ? $userPlatform->path : null;
        }

        return response()->json(['platforms' => PlatformResource::collection($platforms)]);
    }

    public function add(AddPlatformRequest $request)
    {
        $platform = Platform::where('id', $request->platform_id)->first();
        if (!$platform) {
            return response()->json(['message' => 'Platform not found']);
        }

        $platform = DB::table('user_platform')
            ->where('platform_id', $request->platform_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($platform) {
            return response()->json(['message' => 'Platform already addedd']);
        }

        try {
            $latestPlatform = DB::table('user_platform')
                ->where('user_id', auth()->id())
                ->latest()
                ->first();

            $userPlatform = DB::table('user_platform')->insert([
                'user_id' => auth()->id(),
                'platform_id' => $request->platform_id,
                'label' => $request->label,
                'path' => $request->path,
                'platform_order' => $latestPlatform ? ($latestPlatform->platform_order + 1) : 1,
            ]);

            $userPlatform = $this->userPlatform($request->platform_id);
            return response()->json(["message" => "Platform added successfully", 'data' => $userPlatform]);
        } catch (Exception $ex) {
            return response()->json(["message" => $ex->getMessage()]);
        }
    }

    /**
     * Update Platform
     */
    public function update(AddPlatformRequest $request)
    {
        $platform = Platform::where('id', $request->platform_id)->first();
        if (!$platform) {
            return response()->json(['message' => 'Platform not found']);
        }

        $platform = DB::table('user_platform')
            ->where('platform_id', $request->platform_id)
            ->where('user_id', auth()->id())
            ->first();
        if (!$platform) {
            return response()->json(['message' => 'Platform is not assocciated with user']);
        }

        try {
            DB::table('user_platform')
                ->where('platform_id', $request->platform_id)
                ->where('user_id', auth()->id())
                ->update([
                    'label' => $request->label,
                    'path' => $request->path,
                ]);

            $userPlatform = $this->userPlatform($request->platform_id);
            if ($userPlatform) {
                return response()->json(['message' => "Platform updated successfully", 'data' => $userPlatform]);
            }
        } catch (Exception $ex) {
            return response()->json(["message" => $ex->getMessage()]);
        }
    }

    /**
     * Remove platform
     */
    public function remove(PlatformRequest $request)
    {
        $platform = DB::table('user_platform')
            ->where('user_id', auth()->id())
            ->where('platform_id', $request->platform_id)
            ->delete();
        if (!$platform) {
            return response()->json(['message' => 'Platform is not exist']);
        }

        return response()->json(['message' => 'Plateform removed successfully']);
    }

    /**
     * Swap order
     */
    // public function swap(SwapPlatformRequest $request)
    // {
    //     if (!is_array($request->orderList)) {
    //         return response()->json(['message' => "order list must be an array"]);
    //     }

    //     $orderList = json_decode(json_encode($request->orderList));

    //     $id = array_column($orderList, 'id');
    //     array_multisort($id, SORT_ASC, $orderList);

    //     foreach ($orderList as $index => $platform) {

    //         DB::table('user_platform')->where('user_id', auth()->id())
    //             ->where('platform_id', $platform->id)
    //             ->update(
    //                 [
    //                     'platform_order' => $platform->order
    //                 ]
    //             );
    //     }

    //     return response()->json(['message' => "Order swapped successfully"]);
    // }

    /**
     * Direct
     */
    // public function direct(PlatformRequest $request)
    // {
    //     $userPlatform = DB::table('user_platform')
    //         ->where('user_id', auth()->id())
    //         ->where('platform_id', $request->platform_id)
    //         ->first();
    //     if (!$userPlatform) {
    //         return response()->json(['message' => 'Platform not found']);
    //     }

    //     try {
    //         DB::table('user_platform')
    //             ->where('user_id', auth()->id())
    //             ->where('platform_id', $request->platform_id)
    //             ->update([
    //                 'direct' => $userPlatform->direct ? 0 : 1
    //             ]);

    //         if ($userPlatform->direct) {
    //             return response()->json(['message' => 'Plateform updated to hide successfully']);
    //         }
    //         return response()->json(['message' => 'Plateform updated to visible successfully']);
    //     } catch (Exception $ex) {
    //         return response()->json(['message' => $ex->getMessage()]);
    //     }
    // }

    /**
     * Increment Click
     */
    // public function incrementClick(IncrementRequest $request)
    // {
    //     if ($request->user_id == auth()->id()) {
    //         return response()->json(['message' => 'You can not click your own platform']);
    //     }

    //     DB::table('user_platform')
    //         ->where('platform_id', $request->platform_id)
    //         ->where('user_id', $request->user_id)
    //         ->increment('clicks');

    //     return response()->json(['message' => 'Platform clicked successfully']);
    // }

    public function incrementClick(IncrementRequest $request)
    {
        $userPlatform = DB::table('user_platform')->where([
            ['platform_id', $request->platform_id],
            ['user_id', $request->user_id]
        ])->first();

        if (!$userPlatform) {
            return response()->json(['message' => 'Platform not found']);
        }

        if ($request->user_id == auth()->id()) {
            return response()->json(['message' => 'logged in user can not increment in view on its own platform!']);
        }

        $clickHistory = DB::table('clicks')->where([
            ['user_id', $request->user_id],
            ['platform_id', $request->platform_id],
            ['user_clicked_on_platform_id', auth()->id()]
        ])->first();

        if ($clickHistory) {
            return response()->json(['message' => 'Already Clicked on Platform']);
        }

        DB::table('clicks')->insert([
            'user_id' => $request->user_id,
            'platform_id' => $request->platform_id,
            'user_clicked_on_platform_id' => auth()->id()
        ]);
        DB::table('user_platform')
            ->where('platform_id', $request->platform_id)
            ->where('user_id', $request->user_id)
            ->increment('total_views');

        return response()->json(['message' => 'Platform View Incremented Successfully']);
    }

    /**
     * Platform Response (private)
     */
    private function userPlatform($id)
    {
        $userPlatform = DB::table('user_platform')
            ->select(
                'platforms.id',
                'platforms.title',
                'platforms.icon',
                'platforms.base_url',
                'user_platform.created_at',
                'user_platform.path',
                'user_platform.label',
            )
            ->join('platforms', 'platforms.id', 'user_platform.platform_id')
            ->where('platform_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        return $userPlatform;
    }

    /**
     * Private Method
     */
    private function checkPlatformSaved($platformId, $userPlatforms)
    {

        $platfomrSaved = 0;
        $savedPlatform = null;
        foreach ($userPlatforms as $userPlatform) {
            if ($userPlatform->platform_id == $platformId) {
                $platfomrSaved = 1;
                $savedPlatform = $userPlatform;
                break;
            }
        }

        if ($platfomrSaved) {
            return $savedPlatform;
        }
        return null;
    }
}
