<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class couponController extends Controller
        {
          function coupon(){
            return view('coupon',[
              'coupon_list'=>Coupon::all()
            ]);
          }
          function couponPost(Request $req){
            $req->validate([
              'name'=> 'required|unique:coupons,name',
              'persentage'=> 'required|numeric|min:1|max:99',
              'deadline'=> 'required'
            ]);
            Coupon::insert([
              "name"=>$req->name,
              "persentage"=>$req->persentage,
              "deadline"=>$req->deadline,
              "created_at"=>Carbon::now()
            ]);
            return back();
          }
        function deleteCoupon($coupon_id){
          Coupon::find($coupon_id)->forceDelete();
          return back();
        }
        }
