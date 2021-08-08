@extends('layouts.dashboard_master')
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <a class="breadcrumb-item active">Banner Update</a>

    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        <div class="col-md-4 m-auto">
          <div class="card">
          <div class="card-header bg-info">
            <h3>Update Product</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('updateProductPost') }}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="form-group">
              @if (session('update_success_msg'))
                <div class="alert alert-success">
                  {{ session('update_success_msg') }}
                </div>
              @endif
              <label for="exampleInputEmail1">Product Name</label>
              <input type="text" class="form-control" name="product_name" value="{{ $product_name }}">
              <input type="hidden" class="form-control" name="product_id" value="{{ $product_id }}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Product Price</label>
              <input type="text" class="form-control" name="product_price" value="{{$product_price}}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Current Product Photo</label>

              <img type='file' class="form-control" src="{{ asset('uploads/productthumbnail_photo') }}/{{ $product_photo }}" alt="">

            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">New Product Photo</label>
              <input class="form-control" type="file" name="new_product_photo" >
              </div>


            <button type="submit" class="btn btn-primary">Submit</button>
          </form>


          </div>

        </div>

      </div>



  </div>

  </div>

@endsection
