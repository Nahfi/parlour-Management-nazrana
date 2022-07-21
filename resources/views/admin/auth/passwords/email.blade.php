@extends('layouts.admin.auth.admin_auth_app')
@section('admin_auth_content')
<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Don't Panic!</h5>
        <p class="text-muted mt-2">We will send all reset instruction in your email!!!</p>
        @if (Session::has('reset_link_send_success'))
            <div class="alert alert-success">
                {{ Session::get('reset_link_send_success') }}
            </div>
        @endif
    </div>
    <form class="mt-2 pt-2" action="{{ route('admin.resetpassword.post') }}" method="POST">
        @csrf
        <div class="form-floating form-floating-custom mb-4">
            <input type="email" class="form-control" id="input-username" name="email" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="input-username">Email</label>
            <div class="form-floating-icon">
            <i data-feather="mail"></i>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Send Password Reset Link</button>
        </div>
    </form>

    <div class="text-center">
        <p class="text-muted mb-0">Do Nothing? <a href="{{ route('admin.login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>


</div>
@endsection
