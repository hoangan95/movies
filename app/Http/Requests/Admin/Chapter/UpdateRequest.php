<?php

namespace App\Http\Requests\Admin\Chapter;

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
            'name_chapter'=>'required|unique:chapter,name_chapter,'.$id.',id',
        ];
    }
    public function messages()
    {
        return [
            'name_chapter.required'=>'Vui lòng nhập tên chapter',      
         ];
    }
}

