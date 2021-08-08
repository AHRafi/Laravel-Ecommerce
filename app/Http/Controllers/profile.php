<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class profile extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    function editprofile(){
     return view('editprofile');
    }
    function editprofilePost(Request $request){
      User::find(Auth::user()->id)->update([
        'name'=>$request->name
      ]);
      return back()->with('success_msg','Your Name Updated Successfully!');

    }
    function editprofilepasswordPost(Request $request){
      $request->validate([
        'old_password'=>'required',
        'password'=>'required|confirmed',
        'password_confirmation'=>'required'
      ]);
      if ($request->old_password == $request->password) {
        return back()->with('error_msg','Old and New Password Can not be Same!');
      }
      $old_password_from_user = $request->old_password;
      $old_old_password_from_db = Auth::user()->password;
      if (Hash::check($old_password_from_user,$old_old_password_from_db)) {
        User::find(Auth::user()->id)->update([
          'password'=>Hash::make($request->password)
        ]);
        return back()->with('success_msg_ok','Password Updated Successfully!');
      }else {
        return back()->with('error_msg_sad','Old Password Did Not Match!');
      }

    }
}
