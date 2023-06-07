<?php

namespace App\Http\Controllers\client;
use App\Http\Requests\Client\loginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class loginController extends Controller
{
    public function login( loginRequest $request){
        $users = DB::table('users')->where('email',$request->email)->first();
        // copy check status của admin qua client.
        if($users->status == 1){
            return redirect()->route('client.home')->with('error', 'Tài khoản hiện đang khóa');
        }
        //  sửa lại redirect là xong.
        $data =[
            'email'=> $request->email,
            'password'=> $request->password,
            'level' => 2
        ];      
        if (Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->route('client.home');
        }else{
            return redirect()->route('client.home')->with('error', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('client.home');
    }

    
}
