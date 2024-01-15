@extends('team.layout.main')
@section('title', 'Ubah Password')
@section('content')
<x-breadcumb title="Account" sub="Ubah Password" />
<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Ubah Password</div>
    </div>
    @if(session('message'))
    <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif
    <div class="col-md-6 p-0">
        <form method="POST" action="{{ route('team.account.password') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label class="form-label">Password Sebelumnya: </label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"
                    placeholder="Current Password" minlength="6">
                @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password Baru: </label>
                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror"
                    placeholder="New Password" minlength="6">
                @error('new_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password: </label>
                <input type="password" name="new_confirm_password" class="form-control @error('new_confirm_password') is-invalid @enderror"
                    placeholder="Confirm Password" minlength="6">
                @error('new_confirm_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
