@extends('layouts.dashboard_master')
@section('coupon')
  active
@endsection
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Coupon</span>
    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              {{ 'Coupon List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Discount Persentage</th>
                    <th>Validity Deadline</th>
                    <th>Validity Status</th>
                    <th>Action</th>

                  </tr>
                </thead>
                @php
                  $flag=1;
                @endphp
                @foreach ($coupon_list as $coupon)
                  <tbody>
                    <tr>
                      <td>{{  $flag  }}</td>
                      <td>{{ $coupon->id }}</td>
                      <td>{{ $coupon->name }}</td>
                      <td>{{ $coupon->persentage }}</td>
                      <td>{{ $coupon->deadline }}</td>
                      <td>
                        @if ($coupon->deadline >= \Carbon\Carbon::now()->format('Y-m-d'))
                          <span class="badge badge-success">Valid</span>
                          @else
                            <span class="badge badge-danger">Invalid</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ url("deleteCoupon") }}/{{ $coupon->id }}" type="button" class="btn btn-secondary">Delete</a>
                      </td>

                    </tr>
                  </tbody>
                  @php
                    $flag++;
                  @endphp
                @endforeach

              </table>
              {{-- {{ $category_lists->links() }} --}}


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
                @forelse ($deleted_categories as $deleted_category)
                  <tbody>
                    <tr>
                      <td>{{ $loop->index + 1  }}</td>
                      <td>{{ $deleted_category->id }}</td>
                      <td>{{ $deleted_category->Name }}</td>
                      <td>{{ App\User::find($deleted_category->User_ID)->name }}</td>
                      <td>{{ $deleted_category->created_at->DiffForHumans() }}</td>
                      <td>
                        <a href="{{ url('restore') }}/{{ $deleted_category->id }}" type="button" class="btn btn-light">Restore</a>
                        <a href="{{ url("harddelete") }}/{{ $deleted_category->id }}" type="button" class="btn btn-secondary">H Delete</a>
                      </td>
                    </tr>
                  </tbody>
                @empty
                  <tr>
                    <td colspan="50"><span class="text-danger"> No Data To show</span></td>
                  </tr>

                @endforelse

              </table>
              {{ $category_lists->links() }}


            </div>

          </div> --}}

        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              {{ 'Add Coupon' }}
            </div>
            <div class="card-body">
              <form action="{{ url('couponPost') }}" method="post" >
                @csrf
                @if (session("success_msg"))
                  <div class="alert alert-success">
                    {{ session("success_msg") }}
                  </div>

                @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Coupon Name</label>
                <input type="text" class="form-control"  name='name'>


              @error ('name')
                <span class="text-danger"> {{  $message }}  </span>
              @enderror
                <label for="exampleInputEmail1">Discount Persentage(%)</label>
                <input type="integer" class="form-control"  name='persentage'>


              @error ('persentage')
                <span class="text-danger"> {{  $message }}  </span>
              @enderror
                <label for="exampleInputEmail1">Validity Deadline</label>
                <input type="date" class="form-control"  name='deadline' >


              @error ('deadline')
                <span class="text-danger"> {{  $message }}  </span>
              @enderror

              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>

            </div>

          </div>

        </div>


      </div>
      </div>
      </div>
@endsection
