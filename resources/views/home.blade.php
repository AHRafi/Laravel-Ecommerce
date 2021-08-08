@extends('layouts.dashboard_master')

@section('home')
  active
@endsection

@section('content')


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>

      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  <h3>Welcome, {{ Auth::user()->name }}</h3>
                  <h3>Email: {{ Auth::user()->email }}</h3>
                </div>

                <div class="card-body">
                  <h4 class="text-danger">User List</h4>
                  @if (session("del_msg"))
                    <div class="alert alert-danger">
                      {{ session("del_msg") }}
                    </div>

                  @endif

                    <table class="table table-border">
                      <thead>
                        <tr>
                          <th>Serial</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Created At</th>
                          <th>Action</th>

                        </tr>
                      </thead>
                      @foreach ($user_list as $u_list)
                        <tbody>
                          <tr>
                            <td>{{ $user_list->firstItem() + $loop->index }}</td>
                            <td>{{ $u_list->id }}</td>
                            <td>{{ $u_list->name }}</td>
                            <td>{{ $u_list->email }}</td>
                            <td>{{ $u_list->created_at }}</td>
                            <td>
                              <a href="{{ url("deleteUser") }}/{{ $u_list->id }}" type="button" class="btn btn-secondary">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      @endforeach
                    </table>
                    {{ $user_list->links() }}

                </div>
            </div>
        </div>

        </div><!-- row -->


      </div>
    </div>
@endsection
