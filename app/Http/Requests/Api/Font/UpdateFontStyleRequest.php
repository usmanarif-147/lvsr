<?php

namespace App\Http\Requests\Api\Font;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFontStyleRequest extends FormRequest
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
        return [
            'fn_style_id' => ['required']
        ];
    }
}
