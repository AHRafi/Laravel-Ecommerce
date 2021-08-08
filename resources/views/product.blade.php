@extends('layouts.dashboard_master')
@section('product')
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
              {{ 'Product List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category Name(ID)</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Short Description</th>
                    <th>Long Description</th>
                    <th>Photo</th>
                    <th>Created At</th>
                    <th>Action</th>

                  </tr>
                </thead>
                @foreach ($products as $product)


                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->relationtocategorytable->Name }}</td>
                    {{-- <td>{{ App\Category::find($product->category_name)->Name }}</td> --}}
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->product_short_description }}</td>
                    <td>{{ $product->product_long_description }}</td>
                    <td> <img src="{{ asset('uploads/productthumbnail_photo') }}/{{ $product->product_thumbnail_photo }}" width='50' alt="Not Found!"></td>
                    <td>{{ $product->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url('updateProduct') }}/{{ $product->id }}" type="button" class="btn btn-light">Update</a>
                      <a href="{{ url("deleteProduct") }}/{{ $product->id }}" type="button" class="btn btn-secondary">Delete</a>
                    </td>
                  </tr>
                </tbody>


                  @endforeach

              </table>



            </div>

          </div>
          <div class="card">
            <div class="card-header text-white bg-danger">
              {{ 'Deleted Product List' }}
            </div>
            <div class="card-body">
              <table class="table table-border">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category Name(ID)</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Short Description</th>
                    <th>Long Description</th>
                    <th>Photo</th>
                    <th>Created At</th>
                    <th>Action</th>

                  </tr>
                </thead>
                @foreach ($deleted_products as $deleted_product)


                <tbody>
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $deleted_product->id }}</td>
                    <td>{{ $deleted_product->product_name }}</td>
                    <td>{{ $deleted_product->category_name }}</td>
                    <td>{{ $deleted_product->product_price }}</td>
                    <td>{{ $deleted_product->product_quantity }}</td>
                    <td>{{ $deleted_product->product_short_description }}</td>
                    <td>{{ $deleted_product->product_long_description }}</td>
                    <td> <img src="{{ asset('uploads/productthumbnail_photo') }}/{{ $deleted_product->product_thumbnail_photo }}" width='50' alt="Not Found!"></td>
                    <td>{{ $deleted_product->created_at->diffForHumans() }}</td>
                    <td>
                      <a href="{{ url('restoreProduct') }}/{{ $deleted_product->id }}" type="button" class="btn btn-light">Restore</a>
                      <a href="{{ url("harddeleteProduct") }}/{{ $deleted_product->id }}" type="button" class="btn btn-secondary">H Delete</a>
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
              {{ 'Add Product' }}
            </div>
            <div class="card-body">
              <form action="{{ url('productPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (session("success_msg"))
                  <div class="alert alert-success">
                    {{ session("success_msg") }}
                  </div>

                @endif
              <div class="form-group">
                <label for="exampleInputEmail1">Product Name</label>
                <input type="text" class="form-control" name='product_name'>

              </div>

                <label for="exampleInputEmail1">Category Name</label>
                <select class="form-control" name="category_name">
                  <option value="">-Select One-</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{$category->Name}}</option>
                  @endforeach

                </select>

                <label for="exampleInputEmail1">Product Price</label>
                <input type="number" class="form-control"  name='product_price'>

                <label for="exampleInputEmail1">Product Quantity</label>
                <input type="number" class="form-control"  name='product_quantity'>


                <label for="exampleInputEmail1">Product Short Description</label>
                <textarea name="product_short_description" class="form-control" rows="3"></textarea>


                <label for="exampleInputEmail1">Product Long Description</label>
                <textarea name="product_long_description" class="form-control" rows="3"></textarea>

                <label for="exampleInputEmail1">Product Thumbnail Photo</label>
                <input type="file" class="form-control"  name='product_thumbnail_photo'>

                <label for="exampleInputEmail1">Product Multiple Photo</label>
                <input type="file" class="form-control"  name='product_multiple_photo[]' multiple>

              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>

          </div>

        </div>



      </div>
    </div>

@endsection
