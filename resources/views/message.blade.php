@extends('layouts.dashboard_master')

@section('message')
  active
@endsection

@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Message</span>
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
              {{ 'Message List' }}
            </div>
            <div class="card-body">
              <table class="table table-bordere">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Sent Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach ($messages as $message)
                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name}}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url("deleteMessage") }}/{{ $message->id }}" type="button" class="btn btn-secondary">Delete</a>
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
