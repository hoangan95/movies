<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class registrationRequest extends FormRequest
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
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'fullname'=>'required',
            'phone'=>'required',
            'adress'=>'required',
            'level'=>'required',
            'image'=>'required',
            'adress'=>'required'
        ];
    }
    public function messages(){
        return[
            'email.required'=>'Vui lòng nhập email',
            'email.unique'=>'Người dùng này đả tồn tại rồi',
            'fullname.required'=>'Vui lòng nhập họ tên',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'adress.required'=>'Vui lòng nhập địa chỉ liên hệ',
            'level.required'=>'Vui lòng nhập quyền hạn',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'image.required'=>'Vui lòng nhập ảnh',
            'adress.required'=>'Vui lòng nhập địa chỉ',

        ];
    }
}
