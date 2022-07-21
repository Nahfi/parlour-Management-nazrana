@extends('layouts.admin.admin_app')
@section('salary_active')
    mm-active
@endsection
@section('site_title')
Salary Information  Show | Bir Beauty
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
                    <h4 class="mb-sm-0 font-size-18">Show Salary Information</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.salary.index') }}">All Salary Information</a></li>
                            <li class="breadcrumb-item active">Show Salary Information</li>
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


                              <div class="row">
                                  <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Employee Name </label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->employee->name }}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Basic Salary </label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->basic_salary}}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Advanced Salary </label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->employee->advanced_payment}}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Remaining Salary </label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->employee->remaining_advanced_payment}}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Payable Salary </label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->payable_salary}}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Punishment Salary </label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->punishment}}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Main Salary </label>

                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $salary->payable_salary -  $salary->employee->advanced_payment }}">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Total Present</label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->total_present}}  ">
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <label for="name">Total Absent</label>
                                            <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="  {{ $salary->total_absent}}  ">
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
