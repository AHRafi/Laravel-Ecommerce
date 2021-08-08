@extends('layouts.dashboard_master')

@section('category')
  active
@endsection

@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Category</span>
    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        <div class="col-md-8">
          <div class="card ">
            <div class="card-header text-white bg-secondary">
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
                    <th>Photo</th>
                    <th>Action</th>

                  </tr>
                </thead>
                @foreach ($category_lists as $category_list)
                  <tbody>
                    <tr>
                      <td>{{ $category_lists->firstItem() + $loop->index }}</td>
                      <td>{{ $category_list->id }}</td>
                      <td>{{ $category_list->Name }}</td>
                      <td>{{ App\User::find($category_list->User_ID)->name }}</td>
                      <td>{{ $category_list->created_at->DiffForHumans() }}</td>
                      <td> <img src="{{ asset('uploads/') }}/{{ $category_list->Category_Photo }}" width='50' alt="Not Found!"> </td>
                      <td>
                        <a href="{{ url('update') }}/{{ $category_list->id }}" type="button" class="btn btn-light">Update</a>
                        <a href="{{ url("delete") }}/{{ $category_list->id }}" type="button" class="btn btn-secondary">Delete</a>
                      </td>
                    </tr>
                  </tbody>

                @endforeach

              </table>
              {{ $category_lists->links() }}


            </div>

          </div>
          <div class="card mt-3">
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

          </div>

        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              {{ 'Add Category' }}
            </div>
            <div class="card-body">
              <form action="{{ url('categoryPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (session("success_msg"))
                  <div class="alert alert-success">
                    {{ session("success_msg") }}
                  </div>

                @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Add Category</label>
                <input type="text" class="form-control" placeholder="Add Category" name='category_name'>

              </div>
              @error ('category_name')
                <span class="text-danger"> {{  $message }}  </span>
              @enderror
                <label for="exampleInputEmail1">Category Photo</label>
                <input type="file" class="form-control"  name='category_photo'>

              </div>
              @error ('category_photo')
                <span class="text-danger"> {{  $message }}  </span>
              @enderror

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>

          </div>

        </div>


      </div>
      </div>
      </div>







@endsection
