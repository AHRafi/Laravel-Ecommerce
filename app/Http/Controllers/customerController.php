<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\carbon;
use Hash;

class customerController extends Controller
{
    function login(){
      return view('login');
    }
    function registration(){
      return view('customer_register');
    }
    function customer_register_post(Request $req){

      if ($req->password == $req->Con_Password) {
        User::insert([
          'name'=>$req->name,
          'email'=>$req->email,
          'password'=>Hash::make($req->password),
          'role'=> 2,
          'created_at'=>Carbon::now()
        ]);
        return redirect('login');
      }
      return back()->with('unsuccess_msg',"Password and Confirm Password did not match!");
    }

}
