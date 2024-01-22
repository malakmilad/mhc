<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class StoreUpdateUser extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'من فضلك ادخل اسم المستخدم',
            'type.required' => 'من فضلك اختر الوظيفة',
            'email.required' => 'من فضلك ادخل البريد الالكتروني',
        ];

    }//end of messages
}
