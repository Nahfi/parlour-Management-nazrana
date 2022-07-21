@extends('layouts.admin.admin_app')
@section('home_active')
    active
@endsection
@section('site_title')
    Dashobard | Bir Beauty
@endsection
@section('admin_css')
    <style>
        .icon{
            font-size: 40px;
            color: #A865AD;
        }
    </style>
@endsection
@section('admin_js_link')
    <script src="{{ asset('chart.js/chart.js') }}"></script>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @if (Auth::guard('admin')->User()->can('dashboard.report.index'))
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
                                    <span> <b>{{ $data['total_invoice'] }}</b> </span>
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
                                    <p>Others Expense</p>
                                    <span> <b>{{ $data['general_expense'] }}</b> </span>
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
                                    <p> Salary Expense</p>
                                    <span> <b>{{ $data['salary_expense'] }}</b> </span>
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
                                    <p>Total Expense</p>
                                    <span> <b>{{ $data['general_expense'] +  $data['salary_expense'] }}</b> </span>
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
                                    <p> Total Booking</p>
                                    <span> <b>{{ $data['total_booking'] }}</b> </span>
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
                                    <p>  Booking Income</p>
                                    <span> <b>{{ $data['booking_income'] }}</b> </span>
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
                                    <p>Total Income</p>
                                    <span> <b>{{ $data['invoice_income']+$data['booking_income'] }}</b> </span>
                                </div>
                                <div class="col-4">
                                    <i class="icon">৳</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- graph start --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2 text-center">
                        <div class="card">
                            <div class="card-header">
                                Current Month Daily  Expense Report
                            </div>
                            <div class="card-body">
                                <canvas id="dailyExpense" height="100px"></canvas>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2 text-center">
                        <div class="card">
                            <div class="card-header">
                                Current Year Monthly Expense Report
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" height="100px"></canvas>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2 text-center">
                            <div class="card">
                            <div class="card-header">
                                Current Month Daily Service Sales Report
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" height="100px"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-2 text-center">
                            <div class="card">
                            <div class="card-header">
                                Current Year Monthly Service Sales Report
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyServiceSalesChart" height="100px"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2 text-center">
                            <div class="card">
                            <div class="card-header">
                                Current Month Daily Service income Report
                            </div>
                            <div class="card-body">
                                <canvas id="dailyServiceIncomeData" height="100px"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2 text-center">
                            <div class="card">
                            <div class="card-header">
                                Current Year Monthly Service income Report
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyServiceIncomeData" height="100px"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2 text-center">
                            <div class="card">
                            <div class="card-header">
                                Current Month Daily Booking Report
                            </div>
                            <div class="card-body">
                                <canvas id="dailyBookingData" height="100px"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-2 text-center">
                            <div class="card">
                            <div class="card-header">
                                Current Year Monthly Booking Report
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyBookingData" height="100px"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
        {{-- graph end --}}

    </div> <!-- container-fluid -->
</div>
@section('admin_js')
<script>
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphDailyExpenseData['daily_expense_data']; ?>`);
        const ctx = document.getElementById('dailyExpense').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total Daily Expense(৳)',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphExpenseData['expense_data']; ?>`);
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total Monthly Expense(৳)',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphSalesData['sales_data']; ?>`);
        const ctx = document.getElementById('salesChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total daily service sales-',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphMonthlyServiceSalesData['monthlyServiceSalesData']; ?>`);
        const ctx = document.getElementById('monthlyServiceSalesChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total Monthly service sales-',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphDailyServiceIncomeData['daily_service_income_data']; ?>`);
        const ctx = document.getElementById('dailyServiceIncomeData').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total daily service income(৳)',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphMonthlyServiceIncomeData['monthly_service_income_data']; ?>`);
        const ctx = document.getElementById('monthlyServiceIncomeData').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total Monthly service income(৳)',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphDailyBookingData['daily_booking_data']; ?>`);
        const ctx = document.getElementById('dailyBookingData').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total Daily Booking Report-',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    $(function(){
        var graphData = JSON.parse(`<?php echo $graphMonthlyBookingData['monthly_booking_data']; ?>`);
        const ctx = document.getElementById('monthlyBookingData').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: graphData.label,
                datasets: [{
                    label: 'Total Monthly Booking Report-',
                    data: graphData.data,
                    backgroundColor: [
                        'rgba(239, 154, 154, 0.5)',
                        'rgba(236, 64, 122, 0.5)',
                        'rgba(171, 71, 188, 0.5)',
                        'rgba(126, 87, 194, 0.5)',
                        'rgba(92, 107, 192, 0.5)',
                        'rgba(120, 144, 156, 0.5)',
                        'rgba(141, 110, 99, 0.5)',
                        'rgba(255, 112, 67, 0.5)',
                        'rgba(255, 238, 88, 0.5)',
                        'rgba(102, 187, 106, 0.5)',
                        'rgba(38, 166, 154, 0.5)',
                        'rgba(41, 182, 246, 0.5)'
                    ],
                    borderColor: [
                        'rgba(239, 154, 154, 1)',
                        'rgba(236, 64, 122, 1)',
                        'rgba(171, 71, 188, 1)',
                        'rgba(126, 87, 194, 1)',
                        'rgba(92, 107, 192, 1)',
                        'rgba(120, 144, 156, 1)',
                        'rgba(141, 110, 99, 1)',
                        'rgba(255, 112, 67, 1)',
                        'rgba(255, 238, 88, 1)',
                        'rgba(102, 187, 106, 1)',
                        'rgba(38, 166, 154, 1)',
                        'rgba(41, 182, 246, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
@endsection
