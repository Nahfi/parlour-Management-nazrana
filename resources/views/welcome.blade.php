<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">
        <title>Wellcome |   Bir Beauty</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Styles -->
        <style>
           .btn{
               border: 1px solid #A55FAA;
               background: #A55FAA;
               width:100%;
               color: #fff;
               transition: 0.2s;
           }
           .btn:hover,
           .btn:focus,
           .btn:focus-visible,
           .btn:active{
               background: #fff;
               color: #A55FAA;
               border: 1px solid #A55FAA;
               box-shadow: none;
               outline: none;
           }
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body style="width:100%;height:100vh; margin">
        <div class="home-page" style="background: #A55FAA;height:100vh;position:relative;">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-12 m-auto"
                    style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%);background: white;border-radius:10px;padding:15px 25px;">
                    <div class="text-center">
                                <a href="{{ url('/')}}">
                                    <img
                                        style="height:80px;width:120px;;"
                                        src="{{ asset('photo/settings/general') }}/{{ generalSettings()->logo_lg_dark }}"
                                        alt="logo" />
                                </a>
                            </div>
                            <div class="btns mt-4 mb-4">
                                <a href="{{ route('admin.login') }}" class="btn mb-2">Admin Login</a>
                                <a href="{{ route('employee.login') }}" class="btn mb-2">Employee Login</a>
                            </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
