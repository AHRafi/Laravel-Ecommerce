@extends('layouts.dashboard_master')
@section('testimonial')
  active
@endsection
@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Testimonials</span>
    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              {{ 'Testimonial List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Name </th>
                    <th>Designation</th>
                    <th>Photo</th>
                    <th>Action</th>
                    <th>Created At</th>

                  </tr>
                </thead>
                @foreach ($testimonials as $testimonial)
                  <tbody>
                    <tr>
                      <td>{{ $loop->index + 1}}</td>
                      <td>{{ $testimonial->id }}</td>
                      <td>{{ $testimonial->description }}</td>
                      <td>{{ $testimonial->name  }}</td>
                      <td>{{  $testimonial->designation  }}</td>
                      <td> <img src="{{ asset('uploads/testimonial') }}/{{ $testimonial->photo }}" width='50' alt="Not Found!"> </td>
                      <td>{{  $testimonial->created_at->diffForHumans()  }}</td>
                      <td>
                        <a href="{{ url('updateTestimonial') }}/{{ $testimonial->id }}" type="button" class="btn btn-light">Update</a>
                        <a href="{{ url("deleteTestimonial") }}/{{ $testimonial->id }}" type="button" class="btn btn-secondary">Delete</a>
                      </td>
                    </tr>
                  </tbody>

                @endforeach

              </table>



            </div>

          </div>
          <div class="card">
            <div class="card-header text-white bg-danger">
              {{ 'Deleted Testimonial List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Name </th>
                    <th>Designation</th>
                    <th>Photo</th>
                    <th>Action</th>
                    <th>Created At</th>

                  </tr>
                </thead>
                @foreach ($deleted_testimonials as $deleted_testimonial)
                  <tbody>
                    <tr>
                      <td>{{ $loop->index + 1}}</td>
                      <td>{{ $deleted_testimonial->id }}</td>
                      <td>{{ $deleted_testimonial->description }}</td>
                      <td>{{ $deleted_testimonial->name  }}</td>
                      <td>{{  $deleted_testimonial->designation  }}</td>
                      <td> <img src="{{ asset('uploads/testimonial') }}/{{ $deleted_testimonial->photo }}" width='50' alt="Not Found!"> </td>
                      <td>{{  $deleted_testimonial->created_at->diffForHumans()  }}</td>
                      <td>
                        <a href="{{ url('restoreTestimonial') }}/{{ $deleted_testimonial->id }}" type="button" class="btn btn-light">Restore</a>
                        <a href="{{ url("harddeleteTestimonial") }}/{{ $deleted_testimonial->id }}" type="button" class="btn btn-secondary">H Delete</a>
                      </td>
                    </tr>
                  </tbody>

                @endforeach

              </table>



            </div>

          </div>


      </div>

        <div class="col-md-3">
          <div class="card">
            <div class="card-header text-white bg-secondary ">
              {{ 'Add Testimonial' }}
            </div>
            <div class="card-body">
              <form action="{{ url('testimonialPost') }}" method="post" enctype="multipart/form-data">
                @csrf

              <div class="form-group">
                <label for="exampleInputEmail1">Testimonial Description</label>
                <input type="text" class="form-control" name='description'>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Testimonial Name</label>
                <input type="text" class="form-control" name='name'>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Testimonial Designation</label>
                <input type="text" class="form-control" name='designation'>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Testimonial Photo</label>
                <input type="file" class="form-control" name='photo'>
              </div>





              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>

          </div>

        </div>



      </div>
      </div>










@endsection
