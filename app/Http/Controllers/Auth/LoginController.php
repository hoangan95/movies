<?php

namespace App\Http\Controllers\auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showlogin(){

        return view('auth.login');
    }

    public function login( LoginRequest $request){
        // lấy dữ liệu của user theo cái email nếu không có user thì return tk không tồn tại.
        $users = DB::table('users')->where('email',$request->email)->first();
        if(!$users) {
            return redirect()->route('auth.login')->with('error', 'Sai tài khoản hoặc mật khẩu');
        }
        // kiểm tra xem status của nó đang bằng bao nhiêu => 1 => out ra thêm msg là tk của m đang bị khóa còn người lại thì tiếp tục
        if($users->status == 1){
            return redirect()->route('auth.login')->with('error', 'Tài khoản hiện đang khóa');
        }
        $data =[
            'email'=> $request->email,
            'password'=> $request->password,
            "level" => 1
        ];
        if (Auth::attempt($data)){
            $request->session()->regenerate();
 
            return redirect()->route('admin.users.index');
        }else{
            return redirect()->route('auth.login')->with('error', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('auth.showlogin');
    }
}
