<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function pageLogin(){
        return view('pages.login');
    }


    public function userLogin(Request $request){
        $data = $request->all();
        $getUser = User::where('email',$data['email'])->where('password',$data['password'])->get();
        $checkUser = User::where('email',$data['email'])->where('password',$data['password'])->count();
        if($checkUser == 0){
            $failed = "Thông tin tài khoản mật khẩu không chính xác";
            return view('pages.login',compact('failed'));
        }
            return view('pages.home',compact('getUser'));
        

        }
}
