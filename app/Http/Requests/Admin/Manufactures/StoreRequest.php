<?php

namespace App\Http\Requests\Admin\Manufactures;

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
            'name'=>'required|unique:manufactures,name',
            'intro'=>'required',
            'status'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Vui lòng nhập tên',
            'name.unique'=>'Nhà sản xuất này đả tồn tại rồi',
            'intro.required'=>'Vui lòng nhập mô tả',
            'status.required'=>'Vui lòng nhập trạng thái'

        ];
    }
}
