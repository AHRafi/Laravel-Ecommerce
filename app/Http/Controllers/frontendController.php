<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Banner;
use App\Testmonial;
use App\Order_list;

class frontendController extends Controller
{
    function index(){

      $categoey_all= Category::all();
      $product_all= Product::latest()->get();
      $banner_all= Banner::all();
      $testimonial_all = Testmonial::all();
      $best_seller = Order_list::all();

      return view('welcome',compact('categoey_all','product_all','banner_all','testimonial_all','best_seller'));
    }
    function about(){
      return view('about');
    }
    function contact(){
      return view('contact');
    }
    function shop(){

      return view('shop',[
        'products'=> Product::all(),
        'categories'=> Category::all()
      ]);
    }

}
