<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function index(){
              $getUser = User::with('role')->whereNotIn('id',[Auth::user()->id])->get();
              return view('admincp.user.index',compact('getUser'));
        }

        public function edit(string $id){
          $role = Role::pluck('role','id');
          $user =User::find($id);
          return view('admincp.user.form',compact('role','user'));
        }
        
        public function update(Request $request,string $id){
            $data = $request->all();
            $user = User::find($id);
            $user->name =$data['name'];
            $user->email =$data['email'];
            $user->role_id = $data['role_id'];
            $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->save();
            // $getUser = User::with('role')->where('updated_at','DESC')->get();
            $getUser = User::with('role')->orderBy('updated_at','DESC')->get();
            return view('admincp.user.index',compact('getUser'));
        }
  

}

