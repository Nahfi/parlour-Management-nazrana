@extends('layouts.admin.admin_app')

@section('product_active')
    mm-active
@endsection
@section('product_products_active')
    active
@endsection

@section('site_title')
    Service Edit | Bir Beauty
@endsection
@section('admin_css_link')
    <!-- choices css -->
<link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
     <!-- choices js -->
  <script src="{{ asset('admin_assets') }}/libs/choices.js/public/assets/scripts/choices.min.js"></script>
  <!-- init js -->
  <script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Service</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">All Services</a></li>
                            <li class="breadcrumb-item active">Update Service</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-6-12 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                          <form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                <div class="col-12 mb-2">

                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Category Name <span class="text-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror mb-2" name="category_id" data-trigger
                                            id="choices-single-default">
                                            <option value="">select category </option>
                                            @foreach ($categories as $category )
                                                <option {{ ($product->category_id == $category->id ? "selected":"") }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Brand Name </label>
                                        <select class="form-control @error('brand_id') is-invalid @enderror mb-2" name="brand_id" data-trigger
                                            id="choices-single-default">
                                            <option value="">select category </option>
                                            @foreach ($brands as $brand )
                                                <option {{ ($product->brand_id == $brand->id ? "selected":"") }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name"> Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $product->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Price <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  value="{{ $product->price }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name"> Image </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  >

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img class="mt-1" style="height: 50px; width:50px " src="{{asset('/admin_assets/images/products/'.$product->photo)}}" alt=""></td>
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Details </label>
                                        <textarea type="text" class="form-control @error('details') is-invalid @enderror" name="details"  cols="30" rows="10">{{ $product->details }}</textarea>


                                        @error('details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select  @error('status') is-invalid @enderror">
                                            <option value="">select status</option>
                                            <option  value="Active" {{ ($product->status == 'Active' ? "selected":"") }}>Active</option>
                                            <option  value="DeActive" {{ ($product->status == 'DeActive' ? "selected":"") }}>DeActive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-4">Update</button>
                          </form>
                         </div>
                         <!-- end row -->
                         <!-- end table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('product_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Service Update Successfully'
            })
    </script>
    @endif
    @if ($errors->any())
    <script>
        Toast.fire({
            icon: 'error',
            title: 'Something wrong, Please try again!!'
        })
</script>
    @endif
@endsection
@endsection
