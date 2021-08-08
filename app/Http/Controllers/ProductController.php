<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_multiple_photo;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    function product(){
      $categories = Category::latest()->get();
      $products = Product::all();
      $deleted_products = Product::onlyTrashed()->get();
      return view('product', compact('categories','products','deleted_products'));
    }
    function productPost(Request $request){


      $product_id = Product::insertGetId([
        'product_name' => $request->product_name,
        'category_name' => $request->category_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_short_description' => $request->product_short_description,
        'product_long_description' => $request->product_long_description,
        'product_thumbnail_photo' => $request->product_thumbnail_photo,
        'created_at'=> Carbon::now()
      ]);
      $uploaded_photo= $request->file('product_thumbnail_photo');
      $new_name= $product_id.".".$uploaded_photo->getClientOriginalExtension();
      $uploaded_location = base_path('public/uploads/productthumbnail_photo/'.$new_name);
      Image::make($uploaded_photo)->resize(600,470)->save($uploaded_location);

      Product::find($product_id)->update([
        'product_thumbnail_photo'=>$new_name
      ]);
      // multiple photo upload start
      $flag=1;
       foreach ($request->file('product_multiple_photo') as $multiple_photo) {
         $uploaded_photo= $multiple_photo;
         $new_name= $product_id."-".$flag.".".$uploaded_photo->getClientOriginalExtension();
         $uploaded_location = base_path('public/uploads/product_multiple_photo/'.$new_name);
         Image::make($uploaded_photo)->resize(600,550)->save($uploaded_location);

         Product_multiple_photo::insert([
           "product_id"=> $product_id,
           "photo_name"=> $new_name,
           "created_at"=> Carbon::now()
         ]);
         $flag++;
       }
       // multiple photo upload end
      return back();
    }

    function updateProduct($product_id_from_link){
      $product_name= Product::find($product_id_from_link)->product_name;
      $product_price= Product::find($product_id_from_link)->product_price;
      $product_id= $product_id_from_link;
      $product_photo= Product::find($product_id_from_link)->product_thumbnail_photo;
      return view("updateProduct",compact('product_name','product_price','product_id','product_photo'));
    }
    function updateProductPost(Request $req){

        if($req->hasFile('new_product_photo')){
        $delete_photo_location = base_path('public/uploads/productthumbnail_photo/'.Product::find($req->product_id)->product_thumbnail_photo);
        unlink($delete_photo_location);

        $uploaded_photo = $req->file('new_product_photo');
        $new_name = $req->product_id.".".$uploaded_photo->getClientOriginalExtension();
        $uploaded_location = base_path('public/uploads/productthumbnail_photo/'.$new_name);
        Image::make($uploaded_photo)->save($uploaded_location);

        Product::find($req->product_id)->update([
          'product_thumbnail_photo'=> $new_name
        ]);
      }

       Product::find($req->product_id)->update([
        'product_name'=> $req->product_name,
        'product_price'=> $req->product_price
      ]);

       return back();
      }
      function deleteProduct($product_id){
        Product::find($product_id)->delete();
        return back();
      }
      function restoreProduct($product_id){
        Product::withTrashed()->find($product_id)->restore();
        return back();
      }
      function harddeleteProduct($product_id){
        Product::withTrashed()->find($product_id)->forceDelete();
        return back();
      }
      function productDetails($product_id){
        $category_id = Product::find($product_id)->category_name;

        return view('productDetails',[
          "product_info"=> Product::find($product_id),
          "related_product"=> Product::where('category_name',$category_id)->where('id','!=',$product_id)->get(),
          "multiple_photos"=> Product_multiple_photo::where('product_id',$product_id)->get()
        ]);
      }
}
