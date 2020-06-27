<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'starting' => 'required|date|before:ending',
            'ending' => 'required|date|after:starting',
            'images' => 'required|array|between:1,3',
            'images*.' => 'required|file|mimes:jpeg,png|size:1000'
        ];
    }
}
