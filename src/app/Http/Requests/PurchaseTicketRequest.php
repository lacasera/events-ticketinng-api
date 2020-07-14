<?php

namespace App\Http\Requests;

use App\Rules\ValidGateway;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseTicketRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|numeric|between:1,5',
            'gateway' => ['required', 'string', Rule::in(['flutterwave'])],
            'txref' => 'required_if:gateway,flutterwave',
            'type' => ['required', Rule::in(['qrcode', 'pincode'])]
        ];
    }
}
