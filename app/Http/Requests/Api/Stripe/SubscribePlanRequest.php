<?php

namespace App\Http\Requests\Api\Stripe;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubscribePlanRequest extends FormRequest
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
        if (request()->segment(3) == 'subscribePlan') {
            return [
                'setup_intent' => ['required'],
                'plan_id' => ['required'],
                'free_trial' => ['required', 'in:0,1']
            ];
        }
        if (request()->segment(3) == 'cancelSubscription' || request()->segment(3) == 'resumeSubscription') {
            return [
                'plan_id' => ['required'],
            ];
        }
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors()->all(),
    //     ], 422));
    // }
}
