<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroup extends FormRequest
{
     public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required|unique:groups,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'من فضلك ادخل اسم المجموعة',
        ];

    }//end of messages
}
