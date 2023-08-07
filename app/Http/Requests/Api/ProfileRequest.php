<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
        if (request()->segment('3') == 'accountSettings') {
            return [
                'username' => ['sometimes', 'string', Rule::unique(User::class)->ignore($this->user()->id)],
                'email' => ['sometimes', 'email', Rule::unique(User::class)->ignore($this->user()->id)],
            ];
        }
        if (request()->segment('3') == 'changePassword') {
            return [
                'old_password' => ['required'],
                'password' => ['required', 'confirmed', 'min:6'],
            ];
        }
        if (request()->segment('3') == 'changeLanguage') {
            return [
                'language' => ['required'],
            ];
        }
        if (request()->segment('3') == 'askQuestion') {
            return [
                'question' => ['required'],
            ];
        }
    }
}
