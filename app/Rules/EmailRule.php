<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class EmailRule implements Rule
{
    /**
     * Adding a custom validation for email
     */
    public function passes($attribute, $value)
    {
        $validator = Validator::make([$attribute => $value], [
            $attribute => app()->environment('local') ? 'email' : 'email:rfc,dns,filter',
        ]);

        return !$validator->fails();
    }

    public function message()
    {
        return "The email must be a valid email address.";
    }
}