@extends('layouts.admin.admin_app')
@section('customer_active')
    mm-active
@endsection
@section('site_title')
   Customer Crate | Bir Beauty
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
                    <h4 class="mb-sm-0 font-size-18">Add Customer</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">All Customer</a></li>
                            <li class="breadcrumb-item active">Add Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">  
                          <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                
                                  
                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="name">Customer Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="cardNumber">Card Number </label>
                                        <input type="number" class="form-control @error('cardNumber') is-invalid @enderror" name="cardNumber" id="cardNumber" value="{{ old('cardNumber') }}">
                                        @error('cardNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="phone">Phone Number </label>
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="address">Address </label>
                                        
                                        <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" >{{ old('address') }}</textarea>

                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>
                                
                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="name">Customer Image </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  >

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-4">
                                    <div class="form-group">
                                        <label for="type">Customer Type <span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-select  @error('type') is-invalid @enderror">
                                            <option value="">select Type</option>
                                            <option  value="Vip" {{ (old("type") == 'Vip' ? "selected":"") }}>Vip</option>
                                            <option  value="Normal" {{ (old("type") == 'Normal' ? "selected":"") }}>Normal</option>
                                            <option  value="Gold" {{ (old("type") == 'Gold' ? "selected":"") }}>Gold</option>
                                            <option  value="Platinum" {{ (old("type") == 'Platinum' ? "selected":"") }}>Platinum</option>
                                            <option  value="Sliver" {{ (old("type") == 'Platinum' ? "selected":"") }}>Silver</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select  @error('name') is-invalid @enderror"">
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
    @if (Session::has('customer_add_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Customer Added Successfully'
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