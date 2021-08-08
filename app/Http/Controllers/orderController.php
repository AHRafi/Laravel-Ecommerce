<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_list;

class orderController extends Controller
{
  function order(){
    return view('order',[
      'orders' => Order::all()
    ]);
  }
  function deleteOrder($order_id){
    Order::find($order_id)->delete();
    return back()->with('del_msg',"Order Deleted Successfully!");
  }
  function orderInfo(){
    return view('orderInfo',[
      'order_info' => Order_list::all()
    ]);
  }
  function deleteOrderInfo($order_id){
    Order_list::find($order_id)->delete();
    return back()->with('del_msg',"Order Information Deleted Successfully!");
  }
}
