{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
@extends('layouts.frontend.auth.frontend_auth_app')
@section('frontend_auth_content')
<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Don't Panic!</h5>
        <p class="text-muted mt-2">We will send all reset instruction in your email!!!</p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <form class="mt-4 pt-2"  method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-floating form-floating-custom mb-4">
            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="input-username" name="email" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="input-username">Email</label>
            <div class="form-floating-icon">
            <i data-feather="mail"></i>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Send Password Reset Link</button>
        </div>
    </form>

    <div class="mt-5 text-center">
        <p class="text-muted mb-0">Do Nothing? <a href="{{ route('admin.login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>


</div>
@endsection