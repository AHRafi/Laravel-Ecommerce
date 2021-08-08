@extends('layouts.dashboard_master')
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <a class="breadcrumb-item active">Testimonial Update</a>

    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        <div class="col-md-4 m-auto">
          <div class="card">
          <div class="card-header bg-info">
            <h3>Update Testimonial</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('updateTestimonialPost') }}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="form-group">
              @if (session('update_success_msg'))
                <div class="alert alert-success">
                  {{ session('update_success_msg') }}
                </div>
              @endif
              <label for="exampleInputEmail1">Update Testimonial Description</label>
              <input type="text" class="form-control" name="description" value="{{ $testimonial_description }}">
              <input type="hidden" class="form-control" name="id" value="{{ $testimonial_id }}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Update Testimonial Name</label>
              <input type="text" class="form-control" name="name" value="{{$testimonial_name}}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Update Testimonial Designation</label>
              <input type="text" class="form-control" name="designation" value="{{$testimonial_designation}}">


            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">Current Testimonial Photo</label>

              <img type='file' class="form-control" src="{{ asset('uploads/testimonial') }}/{{ $testimonial_photo }}" alt="">

            </div>
            <div class="form-group" >
              <label for="exampleInputEmail1">New Testimonial Photo</label>
              <input class="form-control" type="file" name="new_testimonial_photo" >
              </div>


            <button type="submit" class="btn btn-primary">Submit</button>
          </form>


          </div>

        </div>

      </div>



  </div>

  </div>

@endsection
