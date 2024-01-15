@extends('user.layout.auth')
@section('title', 'Reset Password')

@section('content')
<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="index.html" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">
            <span class="avatar avatar-sm navbar-brand-icon mr-0">
                <span class="avatar-title rounded bg-primary"><img
                    src="{{ asset('images/illustration/student/128/white.svg') }}"
                    alt="logo" class="img-fluid" /></span>
                </span>
                Login
            </a>
            <p class="m-0">Reset Password </p>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            
            <div class="form-group">
                <label class="text-label" for="email_2">Email Address:</label>
                <div class="input-group input-group-merge">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-prepended @error('email') is-invalid @enderror" placeholder="Enter your email" autocomplete="off" required>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="far fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
    @endsection
