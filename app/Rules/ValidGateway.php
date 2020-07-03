<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidGateway implements Rule
{

    protected $validGateways = ['flutterwave'];
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !in_array($attribute, $this->validGateways);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute given is not valid. must be one of ['. implode(', ', $this->validGateways) . ']';
    }
}
