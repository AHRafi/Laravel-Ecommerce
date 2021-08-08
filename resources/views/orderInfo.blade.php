@extends('layouts.dashboard_master');
@section('orderInfo')
  active
@endsection
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Order Info</span>
    </nav>

    <div class="sl-pagebody">
      @if (session("del_msg"))
        <div class="alert alert-danger">
          {{ session("del_msg") }}
        </div>

      @endif

      <div class="row row-sm">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              {{ 'Order Info' }}
            </div>
            <div class="card-body">
              <table class="table table-bordere">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>Id</th>
                  <th>Order ID</th>
                  <th>Ordered BY</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Sent time</th>
                  <th>Action</th>

                </tr>
              </thead>
              @foreach ($order_info as $or_info)
                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>

                    <td>{{ $or_info->id}}</td>
                    <td>{{ $or_info->order_id }}</td>
                    <td>{{ App\User::find($or_info->user_id)->name }}</td>
                    <td>{{ App\Product::find($or_info->product_id)->product_name }}</td>
                    <td>{{ $or_info->quantity }}</td>


                    <td>{{ $or_info->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url("deleteOrderInfo") }}/{{ $or_info->id }}" type="button" class="btn btn-secondary">Delete</a>
                    </td>


                  </tr>

                </tbody>

              @endforeach

            </table>



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
@endsection
