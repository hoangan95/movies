<?php

namespace App\Http\Requests\Admin\Lesson;

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
            'name_lesson'=>'required',
            'link'=>'required',
            'movie_id' => 'required|numeric',
            'chapter_id' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name_lesson.required'=>'Vui lòng nhập lesson',
            'link.required'=>'Vui lòng nhập link cho lesson',
            'movie_id.required'=>'Vui lòng nhập phim',
            'movie_id.numeric'=>'Phim nhập phải là số',
            'chapter_id.required'=>'Vui lòng nhập phim',
            'chapter_id.numeric'=>'Phim nhập phải là số',
        ];
    }
}
