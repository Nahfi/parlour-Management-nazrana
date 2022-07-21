@extends('layouts.admin.admin_app')
@section('report_active')
    mm-active
@endsection
@section('site_title')
    Report | Bir Beauty
@endsection
@section('admin_css_link')
       <!-- DataTables -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
   <!-- init js -->
{{-- <script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script> --}}
<!-- Required datatable js -->
<script src="{{ asset('admin_assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/jszip/jszip.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Datatable init js -->
<script src="{{ asset('admin_assets') }}/js/pages/datatables.init.js"></script>
@endsection
@section('admin_css')
    <style>
        .icon{
            font-size: 40px;
            color: #A865AD;
        }
    </style>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Report (Default Last 7 days)</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Report Page</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row mb-4">
            <div class="col-12">
                <form action="{{ route('admin.report.filter') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-4 col-sm-12 mb-2">
                            <label >From</label>
                            <input type="date" class="form-control" name="from">
                        </div>
                        <div class="col-12 col-lg-4 col-md-4 col-sm-12 mb-2">
                            <label >To</label>
                            <input type="date" class="form-control" name="to">
                        </div>
                        <div class="col-12 col-lg-4 col-md-4 col-sm-12 mt-4 mb-2">
                            <button type="submit" class="btn btn-md btn-primary"> <i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('admin.report.index') }}" class="btn btn-md btn-primary"> <i class="fas fa-undo Reset"></i> Reset </a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Admin</p>
                                <span> <b>{{ $data['total_admin'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon fas fa-user-shield"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Employee</p>
                                <span> <b>{{ $data['total_employee'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon  fas fa-users-cog"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Customer</p>
                                <span> <b>{{ $data['total_customer'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon  fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Service</p>
                                <span> <b>{{ $data['total_service'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon  fab fa-servicestack"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Package</p>
                                <span> <b>{{ $data['total_package'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon  fas fa-baby-carriage"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Invoice</p>
                                <span> <b>{{ $data['total_package'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon  fas fa-book"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Others Expenses</p>
                                <span> <b>{{ $data['other_expenses'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Salary Expenses</p>
                                <span> <b>{{ $data['salary_expenses'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Expense</p>
                                <span> <b>{{ $data['salary_expenses'] + $data['salary_expenses'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Invoice Income</p>
                                <span> <b>{{ $data['invoice_income'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Booking Income</p>
                                <span> <b>{{ $data['booking_income'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Income</p>
                                <span> <b>{{ $data['booking_income'] + $data['invoice_income'] }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                            <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">
                                <thead>
                                    <tr>
                                        <th>Expense</th>
                                        <th>Expense Amount(৳)</th>
                                        <th>Income</th>
                                        <th>Income Amount(৳)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Others Expense</td>
                                        <td>{{ $data['other_expenses'] }} </td>
                                        <td>Invoice Income</td>
                                        <td>{{ $data['invoice_income'] }}</td>  
                                    </tr>
                                    <tr>
                                        <td>Salary Expense</td>
                                        <td>{{ $data['salary_expenses'] }}</td>
                                        <td>Booking Income</td>
                                        <td>{{ $data['booking_income'] }}</td>  
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold">Total Expense</td>
                                        <td style="font-weight: bold">{{ $data['salary_expenses'] + $data['other_expenses'] }}</td>
                                        <td style="font-weight: bold">Total Income</td>
                                        <td style="font-weight: bold">{{ $data['booking_income'] + $data['invoice_income'] }}</td>  
                                    </tr>
                                </tbody>
                            </table>
                     
                            <!-- end table -->
                        <!-- end table responsive -->
                    </div>
            </div>
            </div>
        </div>

       

    </div> <!-- container-fluid -->
</div>
@endsection
