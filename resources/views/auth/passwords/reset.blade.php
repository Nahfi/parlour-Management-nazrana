{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.admin.auth.admin_auth_app')
@section('admin_auth_content')
<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Update for Password!</h5>
        <p class="text-muted mt-2">Please fillup all information correctly and submit your request!!</p>
        @if (Session::has('reset_link_send_success'))
            <div class="alert alert-success">
                {{ Session::get('reset_link_send_success') }}
            </div>
        @endif
    </div>
    <form class="mt-4 pt-2" method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="form-floating form-floating-custom mb-4">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email"  class="form-control @error('password') is-invalid @enderror " id="input-username"  name="email" value="{{ $email ?? old('email') }}" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="input-username">Email</label>
            <div class="form-floating-icon">
            <i data-feather="mail"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-4">
            
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-new-password" name="password" placeholder="Enter new password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="input-new-password">New Password</label>
            <div class="form-floating-icon">
                <i data-feather="lock"></i>
            </div>
        </div>
        <div class="form-floating form-floating-custom mb-4">
            
            <input type="password" class="form-control" id="input-new-password_confirm" name="password_confirmation" placeholder="Enter confirm password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="input-new-password_confirm">Confrim Password</label>
            <div class="form-floating-icon">
             <i data-feather="lock"></i>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Update Password</button>
        </div>
    </form>

    <div class="mt-5 text-center">
        <p class="text-muted mb-0">Remember Password? <a href="{{ route('admin.login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>


</div>
@endsection