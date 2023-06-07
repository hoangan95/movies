<?php

namespace App\Http\Requests\Admin\Series;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_series'=>'required',
            'link'=>'required'
        ];
    }
        public function messages()
    {
        return [
            'name_series.required'=>'Vui lòng nhập tên tập phim',  
            'link.required'=>'Vui lòng nhập đường link',      
    
         ];
    }
    
}
