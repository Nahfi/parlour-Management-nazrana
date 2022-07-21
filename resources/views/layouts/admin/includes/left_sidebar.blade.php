<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">


                @if (Auth::guard('admin')->user()->can('dashboard.index'))
                    <li class="@yield('home_active')">
                        <a href="{{ route('admin.home') }}">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('invoice.index'))
                    <li class="@yield('invoice_active')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="dollar-sign"></i>
                            <span data-key="t-ecommerce">invoice</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('invoice.create'))
                                <li><a class="@yield('invoice_invoices_active')" href="{{ route('admin.invoice.create') }}"> <i data-feather="corner-down-right"></i>Create Invoice</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('invoice.showAll'))
                                <li><a class="@yield('invoice_show_active')" href="{{ route('admin.invoice.index') }}"> <i data-feather="corner-down-right"></i>All Invoice</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Auth::guard('admin')->User()->can('booking.index'))
                    <li class="@yield('booking_active')">
                        <a href="{{route('admin.bookingSystem.index')}}">
                            <i data-feather="plus-square"></i>
                            <span data-key="t-dashboard">Booking System</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('employee.index'))
                    <li class="@yield('employee_active')">
                        <a href="{{route('admin.employee.index')}}">
                            <i data-feather="users"></i>
                            <span data-key="t-dashboard">Employee</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('customer.index'))
                    <li class="@yield('customer_active')">
                        <a href="{{route('admin.customer.index')}}">
                            <i data-feather="users"></i>
                            <span data-key="t-dashboard">Customer</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('product.category.index') || Auth::guard('admin')->user()->can('product.brand.index') ||  Auth::guard('admin')->user()->can('product.index'))
                    <li class="@yield('product_active')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="shopping-bag"></i>
                            <span data-key="t-ecommerce">Service</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('product.brand.index'))
                                <li><a class="@yield('product_brand_active')" href="{{ route('admin.product.brand.index') }}"> <i data-feather="corner-down-right"></i>Brand</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('product.category.index'))
                                <li><a class="@yield('product_category_active')" href="{{ route('admin.product.category.index') }}"> <i data-feather="corner-down-right"></i>Category</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('product.index'))
                                <li><a class="@yield('product_products_active')" href="{{ route('admin.product.index') }}"> <i data-feather="corner-down-right"></i>Service</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('package.index'))
                    <li class="@yield('package_active')">
                        <a href="{{route('admin.package.index')}}">
                            <i data-feather="package"></i>
                            <span data-key="t-dashboard">Package</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->User()->can('workingDay.index'))
                    <li class="@yield('working_day_active')">
                        <a href="{{ route('admin.workingDay.index') }}">
                            <i data-feather="calendar"></i>
                            <span data-key="t-dashboard">Working Day</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->User()->can('attendanceRequest.index'))
                    <li class="@yield('attendance_active')">
                        <a href="{{route('admin.attendance.index')}}">
                            <i data-feather="list"></i>
                            <span data-key="t-dashboard">Attendance List</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->User()->can('salary.index'))
                    <li class="@yield('salary_active')">
                        <a href="{{route('admin.salary.index')}}">
                            <i data-feather="clipboard"></i>
                            <span data-key="t-dashboard">Salary Report</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('expense.index') || Auth::guard('admin')->user()->can('expense.category.index'))
                    <li class="@yield('expense_active')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="dollar-sign"></i>
                            <span data-key="t-ecommerce">Expense</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('expense.category.index'))
                                <li><a class="@yield('expense_category_active')" href="{{ route('admin.expense.category.index') }}"> <i data-feather="corner-down-right"></i>Category</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('expense.index'))
                                <li><a class="@yield('expense_expenses_active')" href="{{ route('admin.expense.index') }}"> <i data-feather="corner-down-right"></i>Expenses</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::guard('admin')->User()->can('report.index'))
                    <li class="@yield('report_active')">
                        <a href="{{route('admin.report.index')}}">
                            <i data-feather="pie-chart"></i>
                            <span data-key="t-dashboard">Report</span>
                        </a>
                    </li>
                @endif

                @if (Auth::guard('admin')->user()->can('admin.index') || Auth::guard('admin')->user()->can('role.index'))
                    <li class="@yield('admin_active')">
                        <a href="javascript: void(0);" class="has-arrow" >
                            <i data-feather="users"></i>
                            <span data-key="t-ecommerce">Admin Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('admin.index'))

                            <li><a class="@yield('admin_admin_active')" href="{{ route('admin.admin.index') }}" key="t-products"><i data-feather="user"></i>Admins</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('role.index'))

                            <li><a class="@yield('admin_roles_active')" href="{{ route('admin.roles.index') }}" data-key="t-product-detail"><i data-feather="user"></i>Roles</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->can('generalSettings.index') || Auth::guard('admin')->user()->can('configSettings.index'))
                    <li class="@yield('settings_active')">
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="settings"></i>
                            <span data-key="t-ecommerce">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (Auth::guard('admin')->user()->can('generalSettings.index'))

                            <li><a class="@yield('settings_general_active')" href="{{ route('admin.settings.general') }}"> <i data-feather="corner-down-right"></i>General</a></li>
                            @endif
                            @if (Auth::guard('admin')->user()->can('configSettings.index'))
                            <li><a class="@yield('settings_config_active')" href="{{ route('admin.settings.config') }}"> <i data-feather="corner-down-right"></i>Config</a></li>
                            @endif
                        </ul>
                    </li>
                @endif 
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
