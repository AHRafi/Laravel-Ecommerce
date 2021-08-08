<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Order;
use App\Order_list;
use App\Cart;
use App\Product;
use Carbon\Carbon;
use Auth;

class StripePaymentController extends Controller
{

  public function stripe()
  {
      return view('stripe');
  }


  public function stripePost(Request $request)
  {
    // print_r($request->all());
    // die();
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      Stripe\Charge::create ([
              "amount" => $request->total * 100,
              "currency" => "usd",
              "source" => $request->stripeToken,
              "description" => "Payment From Bismillah Group"
      ]);


      $order_id = Order::insertGetId([
        'user_id'=>Auth::id(),
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'country'=>$request->country,
        'address'=>$request->address,
        'postcode'=>$request->postcode,
        'town'=>$request->town,
        'notes'=>$request->notes,
        'sub_total'=>$request->sub_total,
        'total'=>$request->total,
        'payment_method'=>$request->payment_method,
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

      // Session::flash('success', 'Payment successful!');
      // return back();
  }
}
