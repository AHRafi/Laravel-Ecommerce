<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_list;
use Carbon\Carbon;

class reportController extends Controller
{
  function report(){
    $reports = Order_list::where('created_at', Carbon::today())->get();
    return view('report',compact('reports'));
  }
}
