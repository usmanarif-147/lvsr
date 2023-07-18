<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Link\LinkRequest;
use App\Http\Resources\Api\LinkResource;
use App\Http\Resources\Api\UserLinkResource;
use App\Models\Link;
use App\Models\UserLink;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserLinkController extends Controller
{
    /**
     * Get All Platforms
     */
    public function allLinks()
    {
        $links = Link::all();
        $userLinks = DB::table('user_links')
            ->select(
                'user_links.link_id',
                'user_links.total_views',
                'user_links.url',
                'user_links.label',
            )
            ->join('links', 'links.id', 'user_links.link_id')
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        foreach ($links as $link) {
            //check link saved by user
            $userLink = $this->checkLinkSaved($link->id, $userLinks);

            $link['id'] = $link->id;
            $link['label'] = $link->label;
            $link['icon'] = $link->icon;
            $link['saved'] =  $userLink ? 1 : 0;
            $link['url'] = $userLink ? $userLink->url : null;
        }

        return response()->json(['links' => LinkResource::collection($links)]);
    }

    /**
     * User Links
     */
    // public function allLinks()
    // {
    //     $links = UserLink::where('user_id', auth()->id())->get();
    //     if (count($links) == 0) {
    //         return response()->json(['message' => "Links not Found"]);
    //     }
    //     return response()->json(['links' => UserLinkResource::collection($links)]);
    // }

    /**
     * Add Link
     */
    public function add(LinkRequest $request)
    {
        $link = Link::where('id', $request->link_id)->first();
        if (!$link) {
            return response()->json(['message' => 'Link not found']);
        }

        $checkLink = UserLink::where('link_id', $request->link_id)
            ->where('user_id', auth()->id())
            ->first();
        if ($checkLink) {
            return response()->json(['message' => 'Link already exists']);
        }

        try {
            $link = UserLink::create([
                'user_id' => auth()->id(),
                'link_id' => $request->link_id,
                'url' => str_contains($request->url, 'https') ? $request->url : 'https://' . $request->url,
            ]);

            return response()->json(['message' => "Link Created Successfully"]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    /**
     * Update Link
     */
    public function update(LinkRequest $request)
    {
        $link = UserLink::where('id', $request->link_id)
            ->where('user_id', auth()->id())
            ->first();
        if (!$link) {
            return response()->json(['message' => 'Link not found']);
        }

        try {
            UserLink::where('id', $link->id)
                ->update([
                    'label' => $request->label,
                    'url' => str_contains($request->url, 'https') ? $request->url : 'https://' . $request->url,
                ]);

            $link = UserLink::where('id', $link->id)
                ->where('user_id', auth()->id())
                ->first();

            return response()->json(['message' => "Link updated successfully", 'data' => $link]);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

    /**
     * Remove Link
     */
    public function remove(LinkRequest $request)
    {
        $link = UserLink::where('link_id', $request->link_id)
            ->where('user_id', auth()->id())
            ->first();
        if (!$link) {
            return response()->json(['message' => "Link not found"]);
        }

        $link->delete();
        return response()->json(['message' => "Link deleted successfully"]);
    }

    /**
     * Increment Click
     */
    public function incrementClick(LinkRequest $request)
    {
        $userLink = UserLink::where([
            ['id', $request->link_id],
            ['user_id', $request->user_id]
        ])->first();

        if (!$userLink) {
            return response()->json(['message' => 'Link not found']);
        }

        if ($request->user_id == auth()->id()) {
            return response()->json(['message' => 'logged in user can not increment in view on its own link!']);
        }

        $clickHistory = DB::table('clicks')->where([
            ['user_id', $request->user_id],
            ['link_id', $request->link_id],
            ['user_clicked_on_link_id', auth()->id()]
        ])->first();

        if ($clickHistory) {
            return response()->json(['message' => 'Already Clicked on Link']);
        }

        DB::table('clicks')->insert([
            'user_id' => $request->user_id,
            'link_id' => $request->link_id,
            'user_clicked_on_link_id' => auth()->id()
        ]);
        UserLink::where('id', $request->link_id)->increment('total_views');

        return response()->json(['message' => 'Link View Incremented Successfully']);
    }

    /**
     * Private Method
     */
    private function checkLinkSaved($linkId, $userLinks)
    {

        $linkSaved = 0;
        $savedLink = null;
        foreach ($userLinks as $userLink) {
            if ($userLink->link_id == $linkId) {
                $linkSaved = 1;
                $savedLink = $userLink;
                break;
            }
        }

        if ($linkSaved) {
            return $savedLink;
        }
        return null;
    }
}
