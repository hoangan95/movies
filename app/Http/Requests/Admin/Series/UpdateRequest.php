<?php

namespace App\Http\Requests\Admin\Series;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->route('id');
       
        return [
            'name_series'=>'required|unique:series,name_series,'.$id.',id',
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
