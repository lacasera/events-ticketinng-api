<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'description' => 'string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'payment_account_id' => 'nullable|numeric'
        ];
    }
}
