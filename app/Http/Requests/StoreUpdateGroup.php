<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateGroup extends FormRequest
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
        $id = Request::segment(2);
        
        return [
            'name' => 'required|unique:groups,name,'.$id,
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'من فضلك ادخل اسم المجموعة',
        ];

    }//end of messages
}
