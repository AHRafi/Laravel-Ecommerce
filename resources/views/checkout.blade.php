@extends('layouts.frontend_master')
@section('frontend_master')
  <!-- checkout-area start -->
<div class="checkout-area ptb-100">
 <div class="container">
     <div class="row">
         <div class="col-lg-8">
             <div class="checkout-form form-style">
                 <h3>Billing Details</h3>
                 <form action="{{ url('checkoutPost') }}" method="post">
                   @csrf
                     <div class="row">

                         <div class="col-12">
                             <p>Full Name</p>
                             <input type="text" value="{{Auth::user()->name}}" name="name">
                         </div>
                         <div class="col-sm-6 col-12">
                             <p>Email Address *</p>
                             <input type="email" value="{{Auth::user()->email}}" name="email">
                         </div>
                         <div class="col-sm-6 col-12">
                             <p>Phone No. *</p>
                             <input type="text" name="phone">
                         </div>
                         <div class="col-12">
                             <p>Country *</p>
                             <input type="text" name="country">
                         </div>
                         <div class="col-12">
                             <p>Your Address *</p>
                             <input type="text" name="address">
                         </div>
                         <div class="col-sm-6 col-12">
                             <p>Postcode/ZIP</p>
                             <input type="text" name="postcode">
                         </div>
                         <div class="col-sm-6 col-12">
                             <p>Town/City *</p>
                             <input type="text" name="town">
                         </div>
                         {{-- <div class="col-12">
                             <input id="toggle1" type="checkbox">
                             <label for="toggle1">Pure CSS Accordion</label>
                             <div class="create-account">
                                 <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                 <span>Account password</span>
                                 <input type="password">
                             </div>
                         </div>
                         <div class="col-12">
                             <input id="toggle2" type="checkbox">
                             <label class="fontsize" for="toggle2">Ship to a different address?</label>
                             <div class="row" id="open2">
                                 <div class="col-12">
                                     <p>Country</p>
                                     <select id="s_country">
                                         <option value="1">Select a country</option>
                                         <option value="2">bangladesh</option>
                                         <option value="3">Algeria</option>
                                         <option value="4">Afghanistan</option>
                                         <option value="5">Ghana</option>
                                         <option value="6">Albania</option>
                                         <option value="7">Bahrain</option>
                                         <option value="8">Colombia</option>
                                         <option value="9">Dominican Republic</option>
                                     </select>
                                 </div>
                                 <div class=" col-12">
                                     <p>First Name</p>
                                     <input id="s_f_name" type="text" />
                                 </div>
                                 <div class=" col-12">
                                     <p>Last Name</p>
                                     <input id="s_l_name" type="text" />
                                 </div>
                                 <div class="col-12">
                                     <p>Company Name</p>
                                     <input id="s_c_name" type="text" />
                                 </div>
                                 <div class="col-12">
                                     <p>Address</p>
                                     <input type="text" placeholder="Street address" />
                                 </div>
                                 <div class="col-12">
                                     <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                 </div>
                                 <div class="col-12">
                                     <p>Town / City </p>
                                     <input id="s_city" type="text" placeholder="Town / City" />
                                 </div>
                                 <div class="col-12">
                                     <p>State / County </p>
                                     <input id="s_county" type="text" />
                                 </div>
                                 <div class="col-12">
                                     <p>Postcode / Zip </p>
                                     <input id="s_zip" type="text" placeholder="Postcode / Zip" />
                                 </div>
                                 <div class="col-12">
                                     <p>Email Address </p>
                                     <input id="s_email" type="email" />
                                 </div>
                                 <div class="col-12">
                                     <p>Phone </p>
                                     <input id="s_phone" type="text" placeholder="Phone Number" />
                                 </div>
                             </div>
                         </div> --}}
                         <div class="col-12">
                             <p>Order Notes </p>
                             <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                         </div>

                     </div>

             </div>
         </div>
         <div class="col-lg-4">
             <div class="order-area">
                 <h3>Your Order</h3>
                 <ul class="total-cost">
                   @php
                     $sub_total = 0;
                   @endphp
                   @foreach ($cart_items as $cart_item)
                     <li>{{ App\Product::find($cart_item->product_id)->product_name }} * {{ $cart_item->quantity }} <span class="pull-right">${{ $cart_item->quantity * (App\Product::find($cart_item->product_id)->product_price) }}</span></li>
                    @php
                      $sub_total =$sub_total + ($cart_item->quantity * (App\Product::find($cart_item->product_id)->product_price));
                    @endphp
                   @endforeach
                     <li>Subtotal <span class="pull-right"><strong>${{ $sub_total }}</strong></span></li>
                     <li>Shipping <span class="pull-right">Free</span></li>
                     <li>Total<span class="pull-right">${{ $total }}</span></li>
                 </ul>
                 <ul class="payment-method">
                     {{-- <li>
                         <input id="bank" type="checkbox">
                         <label for="bank">Direct Bank Transfer</label>
                     </li>
                     <li>
                         <input id="paypal" type="checkbox">
                         <label for="paypal">Paypal</label>
                     </li> --}}

                     <li>
                       <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                     </li>

                     <li>
                       <input type="hidden" name="total" value="{{$total}}">
                     </li>
                     <li>
                         <input id="delivery" type="radio" name="payment_method" value="1" checked>
                         <label for="delivery">Cash on Delivery</label>
                     </li>
                     <li>
                         <input id="card" type="radio" name="payment_method" value="2">
                         <label for="card">Credit Card</label>
                     </li>
                 </ul>
                 <button>Place Order</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
</div>
<!-- checkout-area end -->
@endsection
