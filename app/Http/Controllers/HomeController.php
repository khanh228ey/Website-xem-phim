<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //return view('admincp.home');
         $categoryHome = Category::with('movie')->WHERE('status',1)->orderBy('id','ASC')->limit(16)->Get();
        return view('pages.home',compact('categoryHome'));
    }

    public function viewAdmin(){
        return view('admincp.home');
    }
  

  
}
