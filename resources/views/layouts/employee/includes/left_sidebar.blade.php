<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="@yield('home_active')">
                    <a href="{{ route('employee.home') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="@yield('attendance_active')">
                    <a href="{{ route('employee.attendance.index') }}">
                        <i data-feather="check-square"></i>
                        <span data-key="t-dashboard">Attendance</span>
                    </a>
                </li>

                <li class="@yield('salary_active')">
                    <a href="{{ route('employee.salary.index') }}">
                        <i data-feather="smile"></i>
                        <span data-key="t-dashboard">Salary</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
