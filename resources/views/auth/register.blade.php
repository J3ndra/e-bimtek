@extends('user.layout.auth')
@section('title', 'Daftar Akun')

@section('content')
<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="{{ route('home') }}" class="navbar-brand flex-column mb-2 align-items-center mr-0"
            style="min-width: 0">

            <span class="avatar avatar-sm navbar-brand-icon mr-0">

                <span class="avatar-title rounded {{ empty(setting('logo')) ? 'bg-primary' : '' }}">
                    <img src="{{ empty(setting('logo')) ? asset('images/illustration/student/128/white.svg') : Storage::url(setting('logo')) }}" class="img-fluid"
                    alt="logo" />
                </span>

            </span>

            {{ config('app.name') }}
        </a>
        <p class="m-0">Create a new {{ config('app.name') }} account</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label class="text-label" for="name">Nama:</label>
            <div class="input-group input-group-merge">
                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control form-control-prepended @error('name') is-invalid @enderror"
                    placeholder="Enter your name" autocomplete="off" required>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
                @error('name')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="telp">No Whatsapp:</label>
            <div class="input-group input-group-merge">
                <input type="number" name="telp" value="{{ old('telp', '62') }}"
                    class="form-control form-control-prepended @error('telp') is-invalid @enderror"
                    placeholder="Enter your Whatsapp" autocomplete="off" required>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
                @error('telp')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="email_2">Email Address:</label>
            <div class="input-group input-group-merge">
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control form-control-prepended @error('email') is-invalid @enderror"
                    placeholder="Enter your email" autocomplete="off" required>
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
            <label class="text-label" for="password-confirm">Confirm Password:</label>
            <div class="input-group input-group-merge">
                <input type="password" name="password_confirmation" class="form-control form-control-prepended"
                    placeholder="Enter your password-confirm" required>
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary mb-2" type="submit">Create Account</button><br>
            <a class="text-body text-underline" href="{{ route('login') }}">Have an account? Login</a>
        </div>
    </form>
</div>
@endsection
