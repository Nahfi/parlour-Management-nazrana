@extends('layouts.admin.admin_app')

@section('product_active')
    mm-active
@endsection
@section('product_products_active')
    active
@endsection
@section('site_title')
   Service Create | Bir Beauty
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
                    <h4 class="mb-sm-0 font-size-18">Add Service</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">All Services</a></li>
                            <li class="breadcrumb-item active">Add Services</li>
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
                          <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Category Name <span class="text-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror mb-2" name="category_id" data-trigger
                                            id="choices-single-default">
                                            <option value="">select category </option>
                                            @foreach ($categories as $category )
                                                <option {{ (old("category_id") == $category->id ? "selected":"") }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Brand Name</label>
                                        <select class="form-control @error('brand_id') is-invalid @enderror mb-2" name="brand_id" data-trigger
                                            id="choices-single-default">
                                            <option value="">select brand </option>
                                            @foreach ($brands as $brand )
                                                <option {{ (old("brand_id") == $brand->id ? "selected":"") }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Service Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Price <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  value="{{ old('price') }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Service Image </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  >

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Details </label>
                                        <textarea type="text" class="form-control @error('details') is-invalid @enderror" name="details"  cols="30" rows="10">{{old('details')}}</textarea>
                                        @error('details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select  @error('name') is-invalid @enderror">
                                            <option value="">select status</option>
                                            <option  value="Active" {{ (old("status") == 'Active' ? "selected":"") }}>Active</option>
                                            <option  value="DeActive" {{ (old("status") == 'DeActive' ? "selected":"") }}>DeActive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                              </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
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
    @if (Session::has('service_add_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Service Added Successfully'
            })
    </script>
    @endif
    @if (Session::has('package_add_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Package Added Successfully'
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
