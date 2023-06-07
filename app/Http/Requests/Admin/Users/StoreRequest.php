<?php

namespace App\Http\Requests\admin\Users;

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
            'email'=>'required',
            'password'=>'required',
            'fullname'=>'required',
            'phone' => 'required|regex:/0[0-9]{9}/', // Giới hạn 10 ký tự          
            'adress'=>'required',
            'level'=>'required',
            'image'=>'required',
            'adress'=>'required'
        ];
    }
    public function messages(){
        return[
            'email.required'=>'Vui lòng nhập email',
            'fullname.required'=>'Vui lòng nhập họ tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'adress.required'=>'Vui lòng nhập địa chỉ liên hệ',
            'level.required'=>'Vui lòng nhập quyền hạn',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'image.required'=>'Vui lòng nhập ảnh',
            'adress.required'=>'Vui lòng nhập địa chỉ',

        ];
    }
}
