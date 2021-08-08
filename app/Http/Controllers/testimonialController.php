<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testmonial;
use Carbon\Carbon;
use Image;

class testimonialController extends Controller
{
    function testimonial(){
      $testimonials=Testmonial::latest()->get();
      $deleted_testimonials=Testmonial::onlyTrashed()->get();
      return view("testimonial",compact('testimonials','deleted_testimonials'));
    }
    function testimonialPost(Request $req){
    $req->validate([
    'description'=>'required',
    'name'=>'required',
    'designation'=>'required',
    'photo'=>'required|image',
    ]);
    $testitestimonial_id = Testmonial::insertGetId([
      'description'=>$req->description,
      'name'=>$req->name,
      'designation'=>$req->designation,
      'photo'=>$req->photo,
      'created_at'=>Carbon::now()
    ]);

    $uploader_photo = $req->file('photo');
    $new_name = $testitestimonial_id.".".$uploader_photo->getClientOriginalExtension();
    $new_uploaded_location = base_path('public/uploads/testimonial/'.$new_name);
    Image::make($uploader_photo)->save($new_uploaded_location);

    Testmonial::find($testitestimonial_id)->update([
      'photo'=>$new_name
    ]);

    return back();
    }

    function updateTestimonial($testimonial_id){
      $testimonial_description = Testmonial::find($testimonial_id)->description;
      $testimonial_name = Testmonial::find($testimonial_id)->name;
      $testimonial_designation = Testmonial::find($testimonial_id)->designation;
      $testimonial_id = Testmonial::find($testimonial_id)->id;
      $testimonial_photo = Testmonial::find($testimonial_id)->photo;
    return view('updateTestimonial',compact('testimonial_description','testimonial_name','testimonial_designation','testimonial_id','testimonial_photo'));
    }
    function updateTestimonialPost(Request $req){
      if ($req->hasFile('new_testimonial_photo')) {
        $deleted_location = base_path('public/uploads/testimonial/'.Testmonial::find($req->id)->photo);
        unlink($deleted_location);

        $uploader_photo = $req->file('new_testimonial_photo');
        $new_name = $req->id.".".$uploader_photo->getClientOriginalExtension();
        $new_uploaded_location = base_path('public/uploads/testimonial/'.$new_name);
        Image::make($uploader_photo)->save($new_uploaded_location);

        Testmonial::find($req->id)->update([
          'photo'=>$new_name
        ]);


      }
      Testmonial::find($req->id)->update([
        'description'=>$req->description,
        'name'=>$req->name,
        'designation'=>$req->designation
      ]);

      return back();
    }

    function deleteTestimonial($testimonial_id){
      Testmonial::find($testimonial_id)->delete();
      return back();
    }
    function restoreTestimonial($testimonial_id){
      Testmonial::onlyTrashed()->find($testimonial_id)->restore();
      return back();
    }
    function harddeleteTestimonial($testimonial_id){
      Testmonial::onlyTrashed()->find($testimonial_id)->forceDelete();
      return back();
    }


}
