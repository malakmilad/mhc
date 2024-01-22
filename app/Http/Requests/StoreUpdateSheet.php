<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class StoreUpdateSheet extends FormRequest
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
            'isintrest' => 'required',
            'number1' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'من فضلك ادخل اسم المستخدم',
            'isintrest.required' => 'من فضلك اختر من قائمة مهتم ام لا',
            'number1.required' => 'من فضلك ادخل علي الاقل رقم هاتف واحد',
        ];

    }//end of messages
}
