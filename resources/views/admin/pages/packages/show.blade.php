@extends('layouts.admin.admin_app')
@section('package_active')
    mm-active
@endsection
@section('site_title')
   Package Show | Bir Beauty
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
                    <h4 class="mb-sm-0 font-size-18">Show Package</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.package.index') }}">All Packages</a></li>
                            <li class="breadcrumb-item active">Show Package</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                            <div class="row text-center">
                                <div class="col-12 mt-2">


                                    <img class="rounded-circle mt-1" style="height: 80px; width:80px " src="{{asset('/admin_assets/images/products/'.$product->photo)}}" alt=""></td>


                                </div>
                          </div>

                              <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="name">Type</label>

                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $product->type }} ">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Category Name </label>

                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $product->category->name }} ({{ $product->category->status }}) ">



                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Brand Name</label>

                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $product->brand?$product->brand->name:'' }} {{ $product->brand?($product->brand->status):'' }} ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name"> Name</label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $product->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Price</label>
                                        <input disabled type="number" class="form-control @error('price') is-invalid @enderror" name="price"  value="{{ $product->price }}">
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Ratings</label>
                                        @if ($product->service_ratings)
                                        <span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> {{round($product->service_ratings/$product->service_rating_count)}}</span>
                                        @else
                                        <span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> 0 </span>
                                        @endif
                                    </div>
                                  </div>

                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Details </label>
                                        <textarea disabled type="text" class="form-control @error('details') is-invalid @enderror" name="details"  cols="30" rows="10">{{ $product->details }}</textarea>
                                        {{-- <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  value="{{ old('price') }}"> --}}
                                        @error('details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-12 mt-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>

                                        <input disabled type="text" class="form-control @error('price') is-invalid @enderror" name="price"  value="{{ $product->status }}">

                                    </div>
                                  </div>
                              </div>

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
                title: 'Product Update Successfully'
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
