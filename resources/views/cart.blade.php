@extends('layouts.frontend_master')
@section('frontend_master')

  <!-- cart-area start -->
  <div class="cart-area ptb-100">
      <div class="container">
          <div class="row">
            @if (session('invalid_coupon'))
              <div class="container">

                <div class="alert alert-danger">
                  {{ session('invalid_coupon') }}
                </div>
              </div>
            @endif

            @if (session('invalid_coupon_date'))
              <div class="container">
                <div class="alert alert-danger">
                  {{ session('invalid_coupon_date') }}
                </div>
              </div>
            @endif

              <div class="col-12">
                  <form action="{{ url('updateCart') }}" method="post">
                    @csrf
                      <table class="table-responsive cart-wrap">
                          <thead>
                              <tr>
                                  <th class="images">Image</th>
                                  <th class="product">Product</th>
                                  <th class="ptice">Price</th>
                                  <th class="quantity">Quantity</th>
                                  <th class="total">Total</th>
                                  <th class="remove">Remove</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php
                              $subtotal_cart = 0;
                              $flag = 0;
                            @endphp
                            @foreach (App\Cart::where('ip_address',request()->ip())->get() as $cart)

                              <tr>
                                  <td class="images"><img src="{{asset('uploads/productthumbnail_photo')}}/{{ App\Product::find($cart->product_id)->product_thumbnail_photo }}" alt=""></td>
                                  <td class="product"><a href="single-product.html">{{ App\Product::find($cart->product_id)->product_name }} (Avl Q: {{ App\Product::find($cart->product_id)->product_quantity }})</a>
                                  <br>
                                  @if (App\Product::find($cart->product_id)->product_quantity < $cart->quantity)
                                    <span class="text-danger"> You Have to remove or decrease product quantity! </span>
                                    @php
                                      $flag++;
                                    @endphp

                                  @endif
                                  </td>
                                  <td class="ptice">${{ App\Product::find($cart->product_id)->product_price }}</td>

                                  <td class="quantity cart-plus-minus">
                                      <input type="text" value="{{ $cart->quantity }}" name="cart_quantity[{{ $cart->id }}]"/>
                                  </td>
                                  <td class="total">${{ $cart->quantity * (App\Product::find($cart->product_id)->product_price) }}</td>
                                  @php
                                    $subtotal_cart = $subtotal_cart + $cart->quantity * (App\Product::find($cart->product_id)->product_price);
                                  @endphp
                                  <td class="remove"><i>
                                    <a href="{{ url("deleteCartItem") }}/{{ $cart->id }}" class="fa fa-times"></a>
                                  </i></td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                      <div class="row mt-60">
                          <div class="col-xl-4 col-lg-5 col-md-6 ">
                              <div class="cartcupon-wrap">
                                  <ul class="d-flex">
                                      <li>
                                          <button type="submit">Update Cart</button>
                                      </li>
                                        </form>
                                      <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                  </ul>
                                  <h3>Cupon</h3>
                                  <p>Enter Your Cupon Code if You Have One</p>
                                  <div>
                                      <input type="text" placeholder="Cupon Code" id="coupon_text" value="{{ $coupon_name ?? "" }}">
                                      <a class="btn btn-danger" id="apply-coupon-btn">Apply Cupon</a>

                                  </div>
                              </div>
                          </div>
                          <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                              <div class="cart-total text-right">
                                  <h3>Cart Totals</h3>
                                  <ul>
                                      <li><span class="pull-left">Subtotal </span>${{ $subtotal_cart }}</li>
                                      @isset($discount_persentage)
                                        <li><span class="pull-left"> Discount Persentage (-) </span> {{ $discount_persentage }}%</li>
                                      @endisset
                                      @isset($discount_persentage)
                                        <li><span class="pull-left"> Discount Amount (-) </span> {{ $discount_amount = $subtotal_cart*($discount_persentage/100) }}</li>
                                      @endisset
                                      @isset($discount_persentage)
                                        <li><span class="pull-left"> Total </span> ${{ $total = $subtotal_cart - $discount_amount }}</li>
                                        @else
                                        <li><span class="pull-left"> Total </span> ${{ $total = $subtotal_cart }}</li>
                                      @endisset
                                  </ul>
                                  @if ($flag == 0)

                                    <form action="{{ url('checkout') }}" method="post">
                                      @csrf
                                      <input type="hidden" name="total" value="{{ $total }}">
                                      <button class="btn btn-danger">Proceed to Checkout</button>
                                    </form>
                                  @endif
                              </div>
                          </div>
                      </div>

              </div>
          </div>
      </div>
  </div>
  <!-- cart-area end -->
@endsection
