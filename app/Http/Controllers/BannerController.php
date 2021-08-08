<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Image;

class BannerController extends Controller
{
    function banner(){
      $banner_all= Banner::all();
      $deleted_banner_all = Banner::onlyTrashed()->get();
      return view('banner',compact('banner_all','deleted_banner_all'));
    }
    function bannerPost(Request $request){
      // print_r($request->file('new_banner_photo'));


      $banner_id=Banner::insertGetId([
        'name'=>$request->banner_name,
        'description'=>$request->banner_description,
        'banner_photo'=>$request->banner_name,
        'created_at'=>Carbon::now()
      ]);


      $uploaded_photo = $request->file('new_banner_photo');
      $new_name= $banner_id.".".$uploaded_photo->getClientOriginalExtension();
      $new_uploaded_location = base_path('public/uploads/banner/'.$new_name);
      Image::make($uploaded_photo)->resize(1920,1000)->save($new_uploaded_location);

      Banner::find($banner_id)->update([
        'banner_photo'=>$new_name
      ]);


      return back();

    }
    function update($banner_id_from_link){
      $banner_name = Banner::find($banner_id_from_link)->name;
      $banner_description = Banner::find($banner_id_from_link)->description;
      $banner_id = $banner_id_from_link;
      $banner_photo = Banner::find($banner_id_from_link)->banner_photo;

      return view('updateBanner',compact('banner_name','banner_description','banner_id','banner_photo'));
    }
    function updateBannerPost(Request $req){
      // print_r($req->all());
      if ($req->hasFile('new_banner_photo')) {

        $oldphoto_deleted_location = base_path('public/uploads/banner/'.Banner::find($req->banner_id)->banner_photo);
        unlink($oldphoto_deleted_location);

        $uploaded_photo = $req->file('new_banner_photo');
        $new_name= $req->banner_id.".".$uploaded_photo->getClientOriginalExtension();
        $new_uploaded_location = base_path('public/uploads/banner/'.$new_name);
        Image::make($uploaded_photo)->resize(1920,1000)->save($new_uploaded_location);

        Banner::find($req->banner_id)->update([
          "banner_photo" => $new_name
        ]);
      }
      Banner::find($req->banner_id)->update([
        "name"=>$req->banner_name,
        "description"=>$req->banner_description
        ]);
      return back();

    }
    function deleteBanner($banner_id_from_link){
      Banner::find($banner_id_from_link)->delete();
      return back();
    }
    function restoreBanner($banner_id_from_link){
      Banner::onlyTrashed()->find($banner_id_from_link)->restore();
      return back();
    }
    function harddeleteBanner($banner_id_from_link){
      $deleted_photo_location = base_path('public/uploads/banner/'.Banner::onlyTrashed()->find($banner_id_from_link)->banner_photo);
      Banner::onlyTrashed()->find($banner_id_from_link)->forceDelete();
      unlink($deleted_photo_location);
      return back();
    }
}
