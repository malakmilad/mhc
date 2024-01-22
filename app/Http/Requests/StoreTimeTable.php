<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeTable extends FormRequest
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
            //'time' => 'required',
            'sheet_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //'time.required' => 'من فضلك ادخل الوقت',
            'sheet_id.required' => 'من فضلك اختر العميل',
        ];

    }//end of messages
}
