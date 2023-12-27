<?php

namespace App\Http\Controllers;

use App\Models\User1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    // public function pageLogin(){
    //     return view('pages.login');
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->all();

    //     // Truy vấn từ bảng "user" để kiểm tra thông tin đăng nhập
    //     $user = User1::where('email',$credentials['email'])->where('pass',$credentials['pass'])->first();
    //     $check = User1::where('email',$credentials['email'])->where('pass',$credentials['pass'])->count();
    //     if ($check == 1) {
    //         // Xác thực thành công, đăng nhập người dùng
    //         Auth::login($user);

    //         return redirect()->route('homepages');
    //     }

    //     // Xác thực thất bại, chuyển hướng trở lại trang đăng nhập với thông báo lỗi
    //     toastr()->success('Thông báo','Thông tin đăng nhập chưa chính xác');
    //     return redirect()->route('dangnhap');
    // }

    // public function logout()
    // {
    //     Auth::logout();

    //     // Redirect to the home page or any other page after logout
    //     return redirect('')->route('homepages');
    // }
}

