<?php

namespace App\Http\Requests\admin\Cast;

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
            'name'=>'required|unique:cast,name,'.$id.',id',
            'intro' => 'required',

        ];
    }
    public function messages(){
        return[
            'name.required'=>'Vui lòng nhập tên',
            'name.unique'=>'Blog này đả tồn tại rồi',
           'intro.required'=>'Vui lòng nhập mô tả',
        ];
    }
}
