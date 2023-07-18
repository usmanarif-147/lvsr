<?php

namespace App\Http\Requests\Api\Link;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->segment('3') == 'addLink') {
            return [
                'link_id' => ['required'],
                'url' => ['required']
            ];
        }
        if (request()->segment('3') == 'updateLink') {
            return [
                'link_id' => ['required'],
                // 'label' => ['required'],
                'url' => ['required']
            ];
        }
        if (request()->segment('3') == 'removeLink') {
            return [
                'link_id' => ['required'],
            ];
        }
        if (request()->segment('3') == 'linkClick') {
            return [
                'user_id' => ['required'],
                'link_id' => ['required'],
            ];
        }
    }
}
