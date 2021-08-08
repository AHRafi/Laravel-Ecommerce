@extends('layouts.dashboard_master')
@section('banner')
  active
@endsection

@section('content')
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('home') }}">Home</a>
      <span class="breadcrumb-item active">Product</span>
    </nav>

    <div class="sl-pagebody">

      <div class="row row-sm">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              {{ 'Banner List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Banner Name</th>
                    <th>Banner Description</th>
                    <th>Banner Photo</th>
                    <th>Created At</th>
                    <th>Action</th>

                  </tr>
                </thead>
                @foreach ($banner_all as $banner)


                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->name }}</td>
                    <td>{{ $banner->description }}</td>
                    <td> <img src="{{ asset('uploads/banner') }}/{{ $banner->banner_photo }}" width='50' alt="Not Found!"></td>
                    <td>{{ $banner->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url('updateBanner') }}/{{ $banner->id }}" type="button" class="btn btn-light">Update</a>
                      <a href="{{ url("deleteBanner") }}/{{ $banner->id }}" type="button" class="btn btn-secondary">Delete</a>
                    </td>
                  </tr>
                </tbody>


                  @endforeach

              </table>



            </div>

          </div>
          <div class="card">
            <div class="card-header text-white bg-danger">
              {{ 'Deleted Banner List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Banner Name</th>
                    <th>Banner Description</th>
                    <th>Banner Photo</th>
                    <th>Created At</th>
                    <th>Action</th>

                  </tr>
                </thead>
                @forelse ($deleted_banner_all as $deleted_banner)


                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $deleted_banner->id }}</td>
                    <td>{{ $deleted_banner->name }}</td>
                    <td>{{ $deleted_banner->description }}</td>
                    <td> <img src="{{ asset('uploads/banner') }}/{{ $deleted_banner->banner_photo }}" width='50' alt="Not Found!"></td>
                    <td>{{ $deleted_banner->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url('restoreBanner') }}/{{ $deleted_banner->id }}" type="button" class="btn btn-light">Restore</a>
                      <a href="{{ url("harddeleteBanner") }}/{{ $deleted_banner->id }}" type="button" class="btn btn-secondary">H delete</a>
                    </td>
                  </tr>
                </tbody>
              @empty
                <tr>
                  <td colspan="50"><span class="text-danger"> No Data To show</span></td>
                </tr>


              @endforelse

              </table>



            </div>

          </div>


        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-header text-white bg-secondary ">
              {{ 'Add Banner' }}
            </div>
            <div class="card-body">
              <form action="{{ url('bannerPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (session("success_msg"))
                  <div class="alert alert-success">
                    {{ session("success_msg") }}
                  </div>

                @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Banner Name</label>
                <input type="text" class="form-control" name='banner_name'>
                <input type="hidden" class="form-control" name='banner_id'>

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Banner Description</label>
                <input type="text" class="form-control" name='banner_description'>

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Banner Photo</label>
                <input type="file" class="form-control" name='new_banner_photo'>

              </div>

                {{-- <label for="exampleInputEmail1">Category Name</label> --}}
                {{-- <select class="form-control" name="category_name">
                  <option value="">-Select One-</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{$category->Name}}</option>
                  @endforeach

                </select> --}}

                {{-- <label for="exampleInputEmail1">Product Price</label>
                <input type="number" class="form-control"  name='product_price'>

                <label for="exampleInputEmail1">Product Quantity</label>
                <input type="number" class="form-control"  name='product_quantity'>


                <label for="exampleInputEmail1">Product Short Description</label>
                <textarea name="product_short_description" class="form-control" rows="3"></textarea>


                <label for="exampleInputEmail1">Product Long Description</label>
                <textarea name="product_long_description" class="form-control" rows="3"></textarea>

                <label for="exampleInputEmail1">Product Thumbnail Photo</label>
                <input type="file" class="form-control"  name='product_thumbnail_photo'> --}}

              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>

          </div>

        </div>



      </div>
    </div>

@endsection
