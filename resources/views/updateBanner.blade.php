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
            <h3>Update Banner</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('updateBannerPost') }}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="form-group">
              @if (session('update_success_msg'))
                <div class="alert alert-success">
                  {{ session('update_success_msg') }}
                </div>
              @endif
              <label for="exampleInputEmail1">Update Banner Name</label>
              <input type="text" class="form-control" name="banner_name" value="{{ $banner_name }}">
              <input type="hidden" class="form-control" name="banner_id" value="{{ $banner_id }}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Update Banner Description</label>
              <input type="text" class="form-control" name="banner_description" value="{{$banner_description}}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Current Banner Photo</label>

              <img type='file' class="form-control" src="{{ asset('uploads/banner') }}/{{ $banner_photo }}" alt="">

            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">New Banner Photo</label>
              <input class="form-control" type="file" name="new_banner_photo" >
              </div>


            <button type="submit" class="btn btn-primary">Submit</button>
          </form>


          </div>

        </div>

      </div>



  </div>

  </div>

@endsection
