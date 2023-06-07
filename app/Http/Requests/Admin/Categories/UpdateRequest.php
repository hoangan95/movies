<?php

namespace App\Http\Requests\admin\Categories;

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
            'name'=>'required|unique:categories,name,'.$id.',id',           
             'status'=>'required',
             'parent_id' =>'required|numeric',

        ];
    }
    public function messages(){
        return[
            'name.required'=>'Vui lòng nhập tên thể loại',
            // 'name.unique'=>'Thể loại này đả tồn tại rồi',
            'status.required'=>'Vui lòng nhập trạng thái',
            'parent_id.numeric'=>'Thể loại nhập là nhập số',
        ];
    }
}
