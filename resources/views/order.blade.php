@extends('layouts.dashboard_master')
@section('order')
  active
@endsection
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Order</span>
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
              {{ 'Order List' }}
            </div>
            <div class="card-body">
              <table class="table table-bordere">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Country</th>
                  <th>Address</th>
                  <th>PostCode</th>
                  <th>Town</th>
                  <th>Notes</th>
                  <th>SubTotal</th>
                  <th>Total</th>
                  <th>Payment Method</th>
                  <th>Sent time</th>
                  <th>Action</th>

                </tr>
              </thead>
              @foreach ($orders as $order)
                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>

                    <td>{{ $order->name}}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->country }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->postcode }}</td>
                    <td>{{ $order->town }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>{{ $order->sub_total }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                      @if ($order->payment_method == 1)
                        {{ "Cash on Delivery" }}
                      @else
                        {{ "Online Delivery" }}
                      @endif


                    </td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url("deleteOrder") }}/{{ $order->id }}" type="button" class="btn btn-secondary">Delete</a>
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
