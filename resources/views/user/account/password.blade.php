@extends('user.layout.main')
@section('title', 'Ganti Password')
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="flex">
                    <h1 class="h2 m-0">Ganti Password</h1>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-8">
                @if(session('message'))
                <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
                @endif
                <form method="POST" action="{{ route('admin.account.password') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="form-label">Password Sebelumnya: </label>
                        <input type="password" name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            placeholder="Current Password" minlength="6">
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Baru: </label>
                        <input type="password" name="new_password"
                            class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password"
                            minlength="6">
                        @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password: </label>
                        <input type="password" name="new_confirm_password"
                            class="form-control @error('new_confirm_password') is-invalid @enderror"
                            placeholder="Confirm Password" minlength="6">
                        @error('new_confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            @include('user.layout.partials.rightbar')
        </div>

    </div>
</div>
@endsection
