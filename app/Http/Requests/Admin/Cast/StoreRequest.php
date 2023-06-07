<?php

namespace App\Http\Requests\admin\Cast;

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
            'name'=>'required|unique:cast,name',
            'intro' => 'required',
            'image'=>'required',
            'movie_id' => 'required|array',

           
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.unique' => 'Cast này đã tồn tại rồi',
            'image.required' => 'Vui lòng nhập ảnh',
            'intro.required' => 'Giới hạn 100 ký tự',
            'movie_id.required'=>'Vui lòng chọn phim',
           'movie_id.array'=>'Phim bắt buộc phải là mảng'
        ];
    }
    
}
