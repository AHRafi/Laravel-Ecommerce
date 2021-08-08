<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Order;
use App\Product;
use App\Order_list;
use Carbon\Carbon;

class CheckoutController extends Controller
{   function __construct(){
    $this->middleware('auth');
    }
    function index(Request $req){
      if (Auth::user()->role == 1) {
        echo "You are an admin, you can not buy any product!";
      }else {
        return view('checkout',[
          'cart_items' => Cart::where('ip_address',request()->ip())->get(),
          'total' => $req->total
        ]);
      }
    }
    function checkoutPost(Request $req){
      // print_r($req->all());
      if ($req->payment_method == 1) {
        //insert into order table
        $order_id = Order::insertGetId([
          'user_id'=>Auth::id(),
          'name'=>$req->name,
          'email'=>$req->email,
          'phone'=>$req->phone,
          'country'=>$req->country,
          'address'=>$req->address,
          'postcode'=>$req->postcode,
          'town'=>$req->town,
          'notes'=>$req->notes,
          'sub_total'=>$req->sub_total,
          'total'=>$req->total,
          'payment_method'=>$req->payment_method,
          'created_at' => Carbon::now()
        ]);
        foreach (Cart::where('ip_address', request()->ip())->get() as $cart) {
          //insert into order list table
          Order_list::insert([
            'order_id' => $order_id,
            'user_id' => Auth::id(),
            'product_id' => $cart->product_id,
            'quantity' => $cart->quantity,
            'created_at' => Carbon::today()
          ]);
          //product Quantity decrement
          Product::find($cart->product_id)->decrement('product_quantity',$cart->quantity);
          //delete from cart
          Cart::find($cart->id)->delete();

        }

        return redirect('/');
      }else{
        return view('stripe',[
          'request_all_data' => $req->all()
        ]);
      }

    }
}
