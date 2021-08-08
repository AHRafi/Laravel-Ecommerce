<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Carbon\carbon;
use Image;

class addCategory extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function category(){
      $category_lists = Category::latest()->paginate(2);
      $deleted_categories = Category::onlyTrashed()->get();

      return view('category',compact('category_lists','deleted_categories'));
    }
    function categoryPost(Request $request){
      $request->validate([
        'category_name'=>'required|unique:categories,Name',
        'category_photo'=>'required|image'
      ],[
        'category_name.required'=>"Please, Insert Category!"
      ]);
      $category_id = Category::insertGetId([
        'Name'=>$request->category_name,
        'User_ID'=>Auth::user()->id,
        'Category_Photo'=>$request->category_name,
        'created_at'=>Carbon::now()
      ]);

      $uploaded_photo= $request->file('category_photo');
      $new_name= $category_id.".".$uploaded_photo->getClientOriginalExtension();
      $uploaded_location = base_path('public/uploads/'.$new_name);
      Image::make($uploaded_photo)->resize(600,470)->save($uploaded_location);

      Category::find($category_id)->update([
        'Category_Photo'=>$new_name
      ]);

      return back()->with('success_msg','Category Added Successfully!');
    }










    function update($category_id){

       $category_name = Category::find($category_id)->Name;
       $Category_id = $category_id;
       $category_photo= Category::find($category_id)->Category_Photo;

      return view('update',compact('category_name','Category_id','category_photo'));
    }

    function updateCategoryPost(Request $request){
      if ($request->hasFile('new_cat_photo')) {

        $delete_photo_location= base_path("public/uploads/".Category::find($request->cat_id)->Category_Photo);
        unlink($delete_photo_location);

        $uploaded_photo= $request->file('new_cat_photo');
        $new_name= $request->cat_id.".".$uploaded_photo->getClientOriginalExtension();
        $uploaded_location = base_path('public/uploads/'.$new_name);
        Image::make($uploaded_photo)->resize(600,470)->save($uploaded_location);

        Category::find($request->cat_id)->update([
          "Category_Photo" => $new_name
        ]);
      }
      Category::find($request->cat_id)->update([
        "Name"=>$request->cat_name
      ]);
      return back()->with('update_success_msg','Category Updated Successfully!');

    }

    function delete($category_id){
      Category::find($category_id)->delete();
      return back();
    }
    function restore($category_id){
      Category::withTrashed()->find($category_id)->restore();
      return back();
    }
    function harddelete($category_id){


      $delete_photo_location = base_path('public/uploads/'.Category::onlyTrashed()->find($category_id)->Category_Photo);
      Category::onlyTrashed()->find($category_id)->forceDelete();
      unlink($delete_photo_location);
      return back();

    }
}
