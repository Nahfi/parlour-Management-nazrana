@extends('layouts.employee.auth.employee_auth_app')
@section('employee_auth_page_title')
    Employee Login | GlowOfLifeBD
@endsection
@section('employee_auth_content')
    <div class="">
        <div class="text-center">

        </div>
        @if (Session::has('something_wrong'))
            <div class="alert alert-danger">
                {{ Session::get('something_wrong') }}
            </div>
        @endif
        @if (Session::has('password_reset_time_out'))
            <div class="alert alert-danger">
                {{ Session::get('password_reset_time_out') }}
            </div>
        @endif
        @if (Session::has('password_updated_success'))
            <div class="alert alert-success">
                {{ Session::get('password_updated_success') }}
            </div>
        @endif
        @if (Session::has('email_password_does_not_match'))
            <div class="alert alert-danger">
                {{ Session::get('email_password_does_not_match') }}
            </div>
        @endif
        @if (Session::has('login_failed'))
        <div class="alert alert-danger">
            {{ Session::get('login_failed') }}
        </div>
       @endif
        <form class="mt-2 pt-2" action="{{ route('employee.login.post') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-custom mb-4">
                <input type="text" class="form-control" id="input-username" name="email" placeholder="Enter Email" {{ old('email') ? 'checked' : '' }}>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <label for="input-username">Email</label>
                <div class="form-floating-icon">
                <i data-feather="mail"></i>
                </div>
            </div>
            <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                <input type="password" class="form-control pe-5" id="password-input" name="password" placeholder="Enter Password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                </button>
                <label for="input-password">Password</label>
                <div class="form-floating-icon">
                    <i data-feather="lock"></i>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
            </div>
        </form>

        <div class="mt-2 text-center">
            <p class="text-muted mb-0">Don't remember your account ? <a href="{{ route('employee.resetPassword') }}"
                    class="text-primary fw-semibold"> Forgot Password </a> </p>
        </div>


    </div>
@endsection
