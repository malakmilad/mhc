<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'من فضلك ادخل اسم المستخدم',
            'type.required' => 'من فضلك اختر المجموعة',
            'email.required' => 'من فضلك ادخل البريد الالكتروني',
            'password.required' => 'من فضلك ادخل كلمة المرور',
        ];

    }//end of messages
}
