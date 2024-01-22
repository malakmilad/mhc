<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneType extends FormRequest
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

    public function rules()
    {
        return [
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'من فضلك ادخل النوع',
        ];

    }//end of messages
}
