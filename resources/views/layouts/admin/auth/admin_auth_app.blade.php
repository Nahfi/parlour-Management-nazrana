<!doctype html>
<html lang="en">

<head>

        <meta charset="utf-8" />
        <title>Bir Beauty | BIR it</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">

        @include('layouts.admin.auth.includes.css')

    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page" style="background:#A55FAA;width:100%;">
            <div class="container-fluid">
                <div class="row" style="height: 100vh">
                    <div class="col-lg-4 col-md-6 col-sm-10 m-auto">
                        <div class="d-flex p-4" style="border-radius:10px;background:#fff;">
                            <div class="w-100">
                                <div class="d-flex flex-column">
                                    <div class="mb-2 text-center">
                                        <a href="{{ url('/') }}" class="d-block auth-logo">
                                            <img src="{{ asset('photo/settings/general') }}/{{ generalSettings()->logo_lg_light }}" alt="" height="100">
                                        </a>
                                    </div>
                                    @yield('admin_auth_content')
                                    <div class="mt-2 text-center">
                                        <p class="mb-0">© {{ now()->year }} Bir Beauty by BIR it<br>Developed By <i class="mdi mdi-heart text-danger"></i> <a href="https://birit.com.bd"> BIR  it</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                   
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


       @include('layouts.admin.auth.includes.js')

    </body>
</html>
