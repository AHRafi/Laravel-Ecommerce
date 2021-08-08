@extends('layouts.frontend_master')
@section('frontend_master')
  <div class="account-area ptb-100">
       <div class="container">
           <div class="row">
             @if (session('success_msg'))
               <div class="row">
                 <span>{{ session('success_msg') }}</span>
               </div>
             @endif
             @if (session('unsuccess_msg'))
               <div class="row">
                 <span>{{ session('unsuccess_msg') }}</span>
               </div>
             @endif
               <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                   <div class="account-form form-style">
                     <form action="{{url('customer_register_post')}}" method="post">
                       @csrf
                       <p>Customer Name *</p>
                       <input type="text" name="name">
                       <p>Email Address *</p>
                       <input type="email" name="email">
                       <p>Password *</p>
                       <input type="Password" name="password">
                       <p>Confirm Password *</p>
                       <input type="Password" name="Con_Password">
                       <button>Register</button>
                       </form>
                       {{-- <div class="text-center">
                           <a href="{{ url('customer/login') }}">Or Login</a>
                       </div> --}}

                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection
