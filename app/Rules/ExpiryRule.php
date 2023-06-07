<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ExpiryRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $expiryMonth = $value['exp_month'];
        $expiryYear = $value['exp_year'];

        if ($expiryMonth == $currentMonth && $expiryYear > $currentYear) {
            return true;
        } elseif ($expiryMonth < $currentMonth && $expiryYear > $currentYear) {
            return true;
        } elseif ($expiryMonth > $currentMonth) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is invalid.';
    }
}
