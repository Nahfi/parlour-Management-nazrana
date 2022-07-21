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
                    <h4 class="mb-sm-0 font-size-18">Update Invoice Info</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.invoice.index') }}">All Invoice</a></li>
                            <li class="breadcrumb-item active">Update Invoice</li>
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
                                            <td >
                                                {{$invoices->employee->name}}
                                                <input type="hidden" name="employee_id" value="{{$invoices->employee_id}}">
                                                <input type="hidden" name="service_id" value="{{$invoices->service_id}}">

                                            </td>

                                            <td style="width: 100px">
                                                <button type="submit" name="delete" value="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt" ></i></button>
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
                @if($invoice)

                    <form action="{{route('admin.invoice.update',$invoice->id)}}" method="post">
                        @csrf
                         <div class="row mt-4">

                            <div class="row">
                                <div class="col-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="salary">Discount Type  <span class="text-danger">*</span></label>
                                                <br>
                                                <select name="type" id="status" class=" text-center form-select  @error('type') is-invalid @enderror">
                                                    <option value="">select type</option>
                                                    <option  value="%" {{ ($invoice->discountType == '%' ? "selected":"") }}>(%)</option>
                                                    <option  value="flat" {{ ($invoice->discountType == 'flat' ? "selected":"") }}>(&#2547;)</option>
                                                </select>
                                                @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                           </div>
                                        </div>
                                        <div class="col-4 col-lg-4 mt-1">
                                            <div class="form-group">
                                                 <label for="salary">Discount </label>
                                                 <br>
                                                 <input class="form-control @error('discount') is-invalid @enderror " type="text" value="{{$invoice->discount}}" name="discount" id="">
                                                 @error('discount')
                                                 <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>
                                            <button type="submit" name="information" value="comment" class="mt-3 btn btn-sm btn-primary mt-2">Update</button>

                                        </div>
                                        <div class="col-4 col-lg-4 mt-1">
                                            <div class="form-group">
                                                 <label for="salary">Tax (%) </label>
                                                 <br>
                                                 <input class="form-control @error('tax') is-invalid @enderror " type="text" value="{{$invoice->tax}}" name="tax" id="">
                                                 @error('tax')
                                                 <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>

                                        </div>
                                        <div class="col-4 col-lg-4 mt-1">
                                            <div class="form-group">
                                                 <label for="salary">Paid </label>
                                                 <br>
                                                 <input class="form-control @error('paid') is-invalid @enderror " type="text" value="{{$invoice->amountPaid}}" name="paid" id="">
                                                 @error('paid')
                                                 <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>

                                        </div>



                                    </div>

                                </div>
                                <div class="col-6 col-lg-6">
                                    <div class="form-group">
                                            <label for="salary">Comment </label>
                                            <br>
                                            <textarea  style=" width:100%; text-align:start!important;" cols="30" rows="5" class="area text-start  @error('Comment') is-invalid @enderror" name="Comment" id="Comment" name="note" value=""  >
                                                {{$invoice?$invoice->comments:''}}
                                            </textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
            @endif
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
