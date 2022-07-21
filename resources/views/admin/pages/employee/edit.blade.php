@extends('layouts.admin.admin_app')
@section('employee_active')
    mm-active
@endsection
@section('site_title')
   Employee Edit | Bir Beauty
@endsection
@section('admin_css_link')

    <!-- choices css -->
<link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin_assets') }}/css/preloader.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
     <!-- choices js -->
  <script src="{{ asset('admin_assets') }}/libs/rater-js/index.js"></script>
  <!-- ratter js -->
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
                    <h4 class="mb-sm-0 font-size-18">Edit Employee</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">All Employee</a></li>
                            <li class="breadcrumb-item active">Update Employee</li>
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
                          <form action="{{ route('admin.employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="advanced_payment">Advanced Payment</label>
                                        <input step="any"   type="number" class="form-control @error('advanced_payment') is-invalid @enderror" name="advanced_payment" id="phone" value="{{$employee->advanced_payment }}">
                                        @error('advanced_payment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-2">
                                    <div class="form-group">

                                        <label for="name">Employee Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $employee->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                  <div class="form-group">
                                      <label for="phone">Phone Number </label>
                                      <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{$employee->phone }}">
                                      @error('phone')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-4 mt-2">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ $employee->email }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>


                                <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="designation">Designation </label>
                                        <input type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" value="{{ $employee->designation }}">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="identificationNumber"> Nid/Birth-Certificate <span class="text-danger">*</span>  </label>
                                        <input type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" value="{{ $employee->identificationNumber }}">
                                        @error('identificationNumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="salary">Salary  <span class="text-danger">*</span> </label>
                                        <input min="0" type="number"  class="form-control @error('salary') is-invalid @enderror" name="salary" id="salary" value="{{ $employee->salary }}">
                                        @error('salary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-6 mt-2">
                                    <div class="form-group">
                                        <label for="joinDate">Join Date <span class="text-danger">*</span>  </label>
                                        <input type="date" class="form-control @error('joinDate') is-invalid @enderror" name="joinDate" value="{{$employee->joinDate}}"  >

                                        @error('joinDate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="address">Address </label>
                                        <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" >{{ $employee->address }}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="description">Description  </label>

                                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" >{{ $employee->description }}</textarea>

                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                  </div>

                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Employee Image </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  >

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img class="mt-1" style="height: 50px; width:50px " src="{{asset('/admin_assets/images/employees/'.$employee->image)}}" alt=""></td>
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-select  @error('status') is-invalid @enderror">
                                            <option value="">select status</option>
                                            <option  value="Active" {{ ($employee->status == 'Active' ? "selected":"") }}>Active</option>
                                            <option  value="DeActive" {{ ($employee->status == 'DeActive' ? "selected":"") }}>DeActive</option>
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
    <script>
   $(function(){
    $('.star').click(function(e){
       $(this).removeClass('far fa-star').addClass('fas fa-star')
       $(this).prevAll().removeClass('far fa-star').addClass('fas fa-star');
    });

    $('.star').mouseout(function(){
        $(this).removeClass('fas fa-star').addClass('far fa-star')
        $(this).prevAll().removeClass('fas fa-star').addClass('far fa-star');
    });
   })


    </script>
    @if (Session::has('employee_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Employee Update Successfully'
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
