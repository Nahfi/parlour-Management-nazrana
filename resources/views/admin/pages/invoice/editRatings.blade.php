@extends('layouts.admin.admin_app')
@section('invoice_active')
    mm-active
@endsection
@section('invoice_show_active')
    active
@endsection
@section('site_title')
   Invoice Edit | Bir Beauty
@endsection
@section('admin_css_link')

    <style>
        .area {
        text-align: start !important;
        }
        .area {
            text-align: start !important;
            font-size: .8125rem;
            font-weight: 400;
            padding-top: 8px !important;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
       }
       .area:focus{
           outline: none !important;
       }
    </style>


    <!-- choices css -->
<link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
  <!-- editable table js -->
  <script src="{{ asset('admin_assets') }}/libs/table-edits/build/table-edits.min.js"></script>
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
                    <h4 class="mb-sm-0 font-size-18">Give Rating</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.invoice.index') }}">All Invoice</a></li>
                            <li class="breadcrumb-item active">Update Rating</li>
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
                            <div class="table-responsive">
                                <table class="table table-editable table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Servie Name</th>
                                            <th>Employe Name</th>
                                            <th>Service Ratings</th>
                                            <th>Employe Ratings</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoiceInfo as $invoices)
                                    <form action="{{route('admin.invoice.update',$invoices->id)}}" method="post">
                                        @csrf
                                        <tr data-id="1">
                                            <td data-field="id" style="width: 80px">{{$loop->iteration}}</td>
                                            <td>{{$invoices->service->name}}</td>
                                            <td >{{$invoices->employee->name}}</td>
                                            <td>

                                            @if ($invoices->service_ratings)
                                            <span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> {{$invoices->service_ratings}}</span>
                                            @else
                                            <div class="form-group">

                                                <select name="service_ratings" id="status" class="text-center form-select  ">
                                                    <option value="">select ratings</option>
                                                      @for ($i=1;$i<=5;$i++)
                                                      <option value="{{$i}}">{{$i}}  &#9958; </option>

                                                      @endfor
                                                </select>
                                              </div>
                                            @endif

                                                @error('service-point')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="hidden" name="employee_id" value="{{$invoices->employee_id}}">
                                                <input type="hidden" name="service_id" value="{{$invoices->service_id}}">

                                                @if ($invoices->employee_ratings)
                                            <span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i> {{$invoices->employee_ratings}}</span>
                                            @else
                                            <div class="form-group">

                                                <select name="employee_ratings" id="status" class="text-center form-select  ">
                                                    <option  value="">select ratings</option>
                                                      @for ($i=1;$i<=5;$i++)
                                                      <option value="{{$i}}">{{$i}}  &#9958;</option>

                                                      @endfor
                                                </select>
                                              </div>
                                            @endif


                                                @error('employee-point')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td style="width: 100px">
                                                @if(!$invoices->service_ratings || !$invoices->employee_ratings)
                                                <button type="submit" name="save" value="save" class="btn btn-sm btn-primary"><i class="fas fa-save" ></i></button>

                                                @endif



                                            </td>
                                        </tr>
                                    </form>
                                        @endforeach
                                    </tbody>
                                    </table>
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
    @if (Session::has('customer_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Customer Update Successfully'
            })
    </script>
    @endif
    @if (Session::has('point updated'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Service and Employee Point Updated Successfully'
            })
    </script>
    @endif
    @if (Session::has('Information updated'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Information Updated Successfully'
            })
    </script>
    @endif
    @if (Session::has('service deleted'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Service Deleted Successfully'
            })
    </script>
    @endif
    @if (Session::has('% Discount can not be greater than 100'))
    <script>
            Toast.fire({
                icon: 'error',
                title: '% Discount can not be greater than 100'
            })
    </script>
    @endif
    @if (Session::has('flat Discount can not be greater than total amount'))
    <script>
            Toast.fire({
                icon: 'error',
                title: 'flat Discount can not be greater than total amount'
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
