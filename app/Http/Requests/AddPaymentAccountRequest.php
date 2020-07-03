<?php

namespace App\Http\Requests;

use App\Rules\ValidGateway;
use Illuminate\Foundation\Http\FormRequest;

class AddPaymentAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required|string',
            'gateway' => ['required', 'string', new ValidGateway],
            'public_key' => 'required_if:gateway,flutterwave',
            'secret_key' => 'required_if:gateway,flutterwave',
            'encryption_key' => 'required_if:gateway,flutterwave'
        ];
    }
}
