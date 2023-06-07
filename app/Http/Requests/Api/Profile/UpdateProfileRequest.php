<?php

namespace App\Http\Requests\Api\Profile;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
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
            'username' => ['sometimes', 'min:5', 'max:25', 'regex:/^[A-Za-z][A-Za-z0-9_.]{5,25}$/', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['sometimes', 'email', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages()
    {
        return [
            'username.regex' => 'The username must start with a letter and can only contain letters (uppercase or lowercase), numbers, underscores, or periods. It should be between 5 and 25 characters long.'
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors()->all(),
    //     ], 422));
    // }
}
