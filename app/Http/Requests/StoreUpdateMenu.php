<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateMenu extends FormRequest
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
            'name' => 'required|unique:menus,name,'.$id,
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
