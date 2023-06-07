<?php

namespace App\Http\Requests\Admin\Chapter;

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
            'name_chapter'=>'required',
            'movie_id' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name_chapter.required'=>'Vui lòng nhập tên chapter',
            'movie_id.required'=>'Vui lòng nhập phim',
            'movie_id.numeric'=>'Phim nhập phải là số'      
         ];
    }
}
