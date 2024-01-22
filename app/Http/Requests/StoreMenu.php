<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenu extends FormRequest
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
            'name' => 'required|unique:menus,name',
            'icon' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'من فضلك ادخل اسم ألقائمة',
            'icon.required' => 'من فضلك اختر ايكونة القائمة',
        ];

    }//end of messages
}
