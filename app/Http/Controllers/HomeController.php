<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Auth;

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
    public function index()
    {   if(User::find(Auth::id())->role == 1){
        $user_list = User::latest()->paginate(2);
        return view('home',compact('user_list'));
      }else{
        return view("customer_home");
      }
    }
}
