<?php

namespace App\Http\Requests\Api\Stripe;

use App\Rules\ExpiryRule;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PaymentDetailsRequest extends FormRequest
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
            'type' => ['required'],
            'number' => ['required'],
            'exp_month' => [
                'required',
                'date_format:m',
            ],
            'exp_year' => ['required', 'numeric'],
            // 'expiry' => new ExpiryRule(),
            'cvc' => ['required'],
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors()->all(),
    //     ], 422));
    // }
}
