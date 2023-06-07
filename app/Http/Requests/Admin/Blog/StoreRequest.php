<?php

namespace App\Http\Requests\admin\Blog;

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
            'name'=>'required|unique:blog,name',
            'image'=>'required',
            'status'=>'required',
            'director'=>'required',
            'intro'=>'required',

        ];
    }
    public function messages(){
        return[
            'name.required'=>'Vui lòng nhập tên',
            'name.unique'=>'Blog này đả tồn tại rồi',
            'status.required'=>'Vui lòng nhập trạng thái',
           'image.required'=>'Vui lòng nhập ảnh',
           'intro.required'=>'Vui lòng nhập mô tả',
           'director.required'=>'Vui lòng nhập đạo diễn',
        ];
    }

}
