<?php

namespace App\Http\Requests\admin\Movies;

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
            'name'=>'required|unique:movies,name,'.$id.',id',
            'feature'=>'required',
            'director'=>'required',
            'intro' => 'required',
            'time'=>'required',
            'manufacture_id' =>'required|numeric',
            'languages'=>'required',
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
                'languages.required'=>'Vui lòng nhập languages ',
                'manufacture_id.required'=>'Vui lòng nhập nhà sản xuất',
                'manufacture_id.numeric'=>'vui lòng nhập số',
                'category.required'=>'Vui lòng chọn thể loại',
                'category.array'=>'Thể loại bắt buộc phải là mảng'
            ];
        }
}
