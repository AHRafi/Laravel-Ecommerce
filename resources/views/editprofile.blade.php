@extends('layouts.dashboard_master');

@section('content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Edit Profile</span>

    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">

      <div class="col-md-6 m-auto">
        <div class="alert alert-info">
          <h3>Edit Profile</h3>
        </div>
        <div class="card">
          <div class="card-header bg-warning">
            {{ 'Edit Name' }}
          </div>
          <div class="card-body">
            <form action="{{ url('editprofilePost') }}" method="post">
              @csrf
              @if (session("success_msg"))
                <div class="alert alert-success">
                  {{ session("success_msg") }}
                </div>

              @endif
            <div class="form-group">
              <label for="exampleInputEmail1">Edit Name</label>
              <input type="text" class="form-control" name='name' value=" {{ Auth::user()->name}}">

            </div>
            @error ('category_name')
              <span class="text-danger"> {{  $message }}  </span>
            @enderror

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

          </div>

        </div>
        <div class="card mt-3">
          <div class="card-header bg-secondary text-white">
            {{ 'Change Password' }}
          </div>
          <div class="card-body">
            <form action="{{ url('editprofilepasswordPost') }}" method="post">
              @csrf

              @if (session("error_msg"))
                <div class="alert alert-danger">
                  {{ session("error_msg") }}
                </div>

              @endif
              @if (session("error_msg_sad"))
                <div class="alert alert-danger">
                  {{ session("error_msg_sad") }}
                </div>

              @endif
              @if (session("success_msg_ok"))
                <div class="alert alert-info">
                  {{ session("success_msg_ok") }}
                </div>

              @endif
            <div class="form-group">
              <label for="exampleInputEmail1">Enter Old Password</label>
              <input type="text" class="form-control" name='old_password' >

            </div>
            @error ('old_password')
              <span class="text-danger"> {{  $message }}  </span>
            @enderror
            <div class="form-group">
              <label for="exampleInputEmail1">Enter New Password</label>
              <input type="text" class="form-control" name='password' >

            </div>
            @error ('password')
              <span class="text-danger"> {{  $message }}  </span>
            @enderror
            <div class="form-group">
              <label for="exampleInputEmail1">Enter Confirm Password</label>
              <input type="text" class="form-control" name='password_confirmation' >

            </div>
            @error ('password_confirmation')
              <span class="text-danger"> {{  $message }}  </span>
            @enderror

            <button type="submit" class="btn btn-secondary text-white">Submit</button>
          </form>

          </div>

        </div>

      </div>

    </div>

  </div>
  </div>

@endsection
