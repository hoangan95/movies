<?php

namespace App\Http\Requests\admin\Movies;

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
        'name'=>'required|unique:movies,name',
        'feature'=>'required',
        'director'=>'required',
        'intro' => 'required',
        'image'=>'required',
        'time'=>'required',
        'trailer'=>'required',
        'languages'=>'required',
        'manufacture_id' => 'required|numeric',
        'category' => 'required|array',
        ];
    }
    public function messages(){
    return [
            'name.required'=>'Vui lòng nhập tên',
            'name.unique'=>'Phim này đả tồn tại rồi',
            'feature.required'=>'Vui lòng nhập nổi bật',
            'intro.required'=>'Vui lòng nhập mô tả',
            'director.required'=>'Vui lòng nhập tên đạo diễn',
            'time.required'=>'Vui lòng nhập thời lượng phim',
            'trailer.required'=>'Vui lòng nhập trailer',
            'languages.required'=>'Vui lòng nhập trailer',
            'image.required'=>'Vui lòng nhập ảnh',
            'manufacture_id.required'=>'Vui lòng nhập nhà sản xuất',
            'manufacture_id.numeric'=>'vui lòng nhập số',
            'category.required'=>'Vui lòng chọn thể loại',
            'category.array'=>'Thể loại bắt buộc phải là mảng'
        ];
    }
}
