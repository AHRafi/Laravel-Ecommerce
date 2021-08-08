<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Carbon\Carbon;

class favouriteController extends Controller
{
    function addtofavourite(Request $req){
      Favourite::insert([
        'product_id'=>$req->product_id,
        'quantity'=>$req->quantity,
        'ip_address'=>request()->ip(),
        'created_at'=>Carbon::now()
      ]);
      return back();
    }
    function deleteFavtItem($favt_id){
      Favourite::find($favt_id)->forceDelete();
      return back();
    }
}
