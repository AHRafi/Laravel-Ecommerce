<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
    function deleteUser($user_id){
      User::find($user_id)->delete();
      return back()->with('del_msg',"User Deleted Successfully!");
    }
}
