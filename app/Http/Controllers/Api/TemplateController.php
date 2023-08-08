<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Template\TemplateRequest;
use App\Http\Resources\Api\TemplateResource;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    public function allTemplates()
    {
        $templates = Template::all();
        $userTemplate = DB::table('user_templates')
            ->select(
                'templates.id',
                'templates.image'
            )
            ->join('templates', 'templates.id', 'user_templates.template_id')
            ->where('user_id', auth()->id())
            ->get()
            ->toArray();

        foreach ($templates as $template) {
            $template['id'] =  $template->id;
            $template['image'] =  $template->image;
            $template['type'] =  $template->type == 2 ? 'pro' : 'free';
            $template['is_selected'] =  $template->id == $userTemplate[0]->id ? 1 : 0;
        }

        return response()->json(['fontStyles' => TemplateResource::collection($templates)]);
    }

    public function updateTemplate(TemplateRequest $request)
    {
        $color = Template::where('id', $request->template_id)->first();
        if (!$color) {
            return response()->json(['message' => 'Template not Found']);
        }

        // Check Color Already Selected
        $userTemplate = DB::table('user_templates')
            ->where('template_id', $request->template_id)
            ->where('user_id', auth()->id())
            ->first();
        if ($userTemplate) {
            return response()->json(['message' => 'Template Already Selected']);
        }

        // Check Color Is Pro
        if ($color->type == 2 && !auth()->user()->is_subscribed) {
            return response()->json(['message' => 'Please subscribe before select this Template']);
        }

        // Update User Template
        DB::table('user_templates')->where('user_id', auth()->id())
            ->update([
                'template_id' => $color->id
            ]);

        return response()->json(['message' => 'Template is Updated Successfully']);
    }
}
