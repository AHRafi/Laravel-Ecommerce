<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use App\Product;

class cartController extends Controller
{
    function addtocart(Request $req){
      if (Cart::where('ip_address',request()->ip())->where('product_id',$req->product_id)->exists()) {
        Cart::where('ip_address',request()->ip())->where('product_id',$req->product_id)->increment('quantity', $req->quantity);
      }else{
        if (Product::find($req->product_id)->product_quantity < $req->quantity) {
          return back()->with('cart_error','You Can not add more than available Quantity!');
        }else {

        Cart::insert([
          'product_id'=>$req->product_id,
          'quantity'=>$req->quantity,
          'ip_address' => request()->ip(),
          'created_at' => Carbon::now()
        ]);
      }
      }
      return back();
      }
      function deleteCartItem($cart_id){
        Cart::find($cart_id)->forceDelete();
        return back();
      }
      function cartpage($coupon_name = ""){


          if ($coupon_name) {
            if (Coupon::where('name',$coupon_name)->exists()) {
                    if (Coupon::where('name',$coupon_name)->first()->deadline >= Carbon::now()->format('Y-m-d')) {
                     return view('cart',[
                       'discount_persentage'=> Coupon::where('name',$coupon_name)->first()->persentage,
                       'coupon_name'=> Coupon::where('name',$coupon_name)->first()->name
                     ]);
                    }
                    else
                    {
                    return redirect('cartpage')->with('invalid_coupon_date','Coupon Dedline Is Over!');
                    }
            } else {
              return redirect('cartpage')->with('invalid_coupon','Invalid Coupon!');
            }

          }else {
            return view('cart');
            }


      }
      function updateCart(Request $req){
        foreach ($req->cart_quantity as $cart_id => $cart_updated_quantity) {
          // echo "id:".$cart_id."<br>";
          // echo "quantity:".$cart_updated_quantity."<br>";
          Cart::find($cart_id)->update([
            'quantity'=> $cart_updated_quantity
          ]);
        }
        return back();
      }
}
