@extends('layouts.dashboard_master');
@section('report')
  active
@endsection
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Todays Report</span>
    </nav>

    <div class="sl-pagebody">
      @if (session("del_msg"))
        <div class="alert alert-danger">
          {{ session("del_msg") }}
        </div>

      @endif

      <div class="row row-sm">
        <div class="col-md-12">
          <div class="card bg-white">
            <div class="card-header ">
              {{ 'Todays Sell Report' }}
            </div>
            <div class="card-body ">
              <table class="table table-bordered">
              <thead class="bg-white">
                <tr>
                  <th>Serial</th>
                  <th>Order by</th>
                  <th>Product Name</th>
                  <th>Product Quantity</th>
                  <th>Price</th>
                  <th>Total Price</th>

                </tr>
              </thead>

              @php
                $total_price = 0;
              @endphp
              @foreach ( $reports as $report)
                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ App\User::find($report->user_id)->name }}</td>
                    <td>{{ App\Product::find($report->product_id)->product_name}}</td>
                    <td>{{ $report->quantity }}</td>
                    <td>${{ App\Product::find($report->product_id)->product_price }}</td>
                    <td>${{ (App\Order::find($report->order_id)->total) }}</td>
                    @php
                      $total_price = $total_price + (App\Order::find($report->order_id)->total);
                    @endphp

                  </tr>

                </tbody>

              @endforeach
              @if ($total_price == 0)
                <td><span class="text-danger">{{ "There is no sell Today!"  }}</span></td>
              @else
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><span class="text-danger">Total</span></td>
                <td><span class="text-danger">${{ $total_price  }}</span></td>
              @endif


            </table>
            <a style="float: right;" class="btn btn-primary hidethispart" href="javascript:print()">Print</a>



            </div>

          </div>
          {{-- <div class="card mt-3">
            <div class="card-header bg-danger  text-white">
              {{ 'Category List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User </th>
                    <th>Created At</th>
                    <th>Action</th>

                  </tr>
                </thead>


              </table>



            </div>

          </div> --}}

        </div>



      </div>
      </div>
      </div>
