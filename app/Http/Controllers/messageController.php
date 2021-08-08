<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Carbon\Carbon;

class messageController extends Controller
{
    function messagepost(Request $request){
      $request->validate([
        'fname'=> 'required',
        'email'=>'required|email',
        "subject"=>'required',
        "msg"=>'required'
      ]);
      Message::insert([
        "name"=>$request->fname,
        "email"=>$request->email,
        "subject"=>$request->subject,
        "message"=>$request->msg,
        "created_at"=>Carbon::now()
      ]);
      return back()->with('success_msg',"Message Sent Successfully!");

    }
    function message(){
      $messages = Message::all();
      return view('message',compact('messages'));
    }
    function deleteMessage($mess_id){
      Message::find($mess_id)->Delete();
      return back()->with('del_msg',"Message Deleted Successfully!");
    }
}
