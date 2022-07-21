@extends('layouts.admin.admin_app')
@section('expense_active')
    mm-active
@endsection
@section('expense_expenses_active')
    active
@endsection
@section('site_title')
   Expense  Show | Bir Beauty
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Show Expense</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.expense.index') }}">All Expense </a></li>
                            <li class="breadcrumb-item active">Show Expense</li>
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
                              <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="name">Expenses  Name</label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $expense->name }}">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Expenses Category Name</label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $expense->category->name }}">

                                    </div>
                                  </div>
                                  <div class="col-6 ">
                                    <div class="form-group">
                                        <label for="status">Status </label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $expense->status }}">
                                    </div>
                                  </div>
                                  <div class="col-6 mt-4">
                                    <div class="form-group">
                                        <label for="status">Created By </label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $expense->createdBy->name }}">
                                    </div>
                                  </div>
                                  <div class="col-6 mt-4">
                                    <div class="form-group">
                                        <label for="status">Edited By </label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $expense->editedByCategory ?  $category->editedBy->name : 'N/A'}}">
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
