@extends('user.layout.auth')
@section('title', 'Confirm Password')

@section('content')
<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="index.html" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">
            <span class="avatar avatar-sm navbar-brand-icon mr-0">
                <span class="avatar-title rounded bg-primary"><img
                    src="{{ asset('images/illustration/student/128/white.svg') }}"
                    alt="logo" class="img-fluid" /></span>
                </span>
                Confirm Password
            </a>
            <p class="m-0">{{ __('Please confirm your password before continuing.') }}</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            
            <div class="form-group">
                <label class="text-label" for="password_2">Password:</label>
                <div class="input-group input-group-merge">
                    <input type="password" name="password"
                    class="form-control form-control-prepended @error('password') is-invalid @enderror"
                    placeholder="Enter your password" required>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-key"></span>
                        </div>
                    </div>

                    @error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Confirm</button>
            </div>
            <div class="form-group text-center">
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>
        </form>
    </div>
    @endsection
