@extends('layouts.admin.admin_app')
@section('employee_active')
    mm-active
@endsection
@section('site_title')
  Employee show | Bir Beauty
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
                    <h4 class="mb-sm-0 font-size-18">Show Employee</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">All Employee</a></li>
                            <li class="breadcrumb-item active">Show Employee</li>
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
                                        <img class="rounded-circle mt-1" style="height: 100px; width:100px " src="{{asset('/admin_assets/images/employees/'.$employee->image)}}" alt=""></td>
                                  </div>
                            </div>
                              <div class="row">
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Employee Name </label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $employee->name }}">
                                    </div>
                                  </div>
                                <div class="col-12 mt-2">
                                  <div class="form-group">
                                      <label for="phone">Phone Number </label>
                                      <input disabled type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{$employee->phone }}">
                                  </div>
                                </div>
                                <div class="col-12 mt-2">
                                  <div class="form-group">
                                      <label for="address">Address </label>
                                      <textarea disabled type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" >{{ $employee->address }}</textarea>
                                  </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="designation">Designation </label>
                                        <input disabled type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" value="{{ $employee->designation }}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="identificationNumber"> Nid/Birth-Certificate  </label>
                                        <input disabled type="text" class="form-control @error('identificationNumber') is-invalid @enderror" name="identificationNumber" id="identificationNumber" value="{{ $employee->identificationNumber }}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="salary">Salary  </label>
                                        <input disabled min="0" type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" id="salary" value="{{ $employee->salary }}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label  for="point">Ratings </label>
                                        @if ($employee->employee_ratings)
                                         <span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> {{round($employee->employee_ratings/$employee->employee_rating_count)}}</span>
                                        @else
                                          <span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> 0 </span>
                                        @endif
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="joinDate">Join Date   </label>
                                        <input disabled type="date" class="form-control @error('joinDate') is-invalid @enderror" name="joinDate" value="{{$employee->joinDate}}" >
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="description">Description  </label>
                                        <textarea disabled type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" >{{ $employee->description }}</textarea>
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label  for="name"> Advanced Payment </label>
                                        <input type="text" disabled class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $employee->advanced_payment}}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label  for="name">Remaning Advanced Payment </label>
                                        <input type="text" disabled class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $employee->remaining_advanced_payment}}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label  for="name">Created By </label>
                                        <input type="text" disabled class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $employee->employeeCreatedBy->name }}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label  for="name">Edited By </label>
                                        <input type="text" disabled class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $employee->employeeEditedBy?$employee->employeeEditedBy->name:"not edited yet"}}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="status">Status </label>
                                        <input type="text" disabled class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$employee->status}}">
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
@endsection
