@extends('user.layout.main')
@section('title', 'Data Akun: ' . $user->name)
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="flex">
                    <h1 class="h2 m-0">Data Akun: {{ $user->name }}</h1>
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

                @if(!auth()->user()->hasVerifiedEmail())
                @if (session('resent'))
                <x-alert status="success">
                    Link verifikasi telah dikirim ke email kamu.
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </x-alert>
                @endif
                <x-alert status="danger">
                    Email kamu belum terverifikasi, mohon segera diverifikasikan.
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm ml-3">Kirim email verifikasi</button>.
                </form>
                </x-alert>
                @endif
                <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="form-label">Avatar</label>
                        <div class="clearfix"></div>
                        <div class="avatar avatar-xl mb-2">
                            @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                            class="avatar-img rounded-circle">
                            @else
                            <span class="avatar-title rounded">{{ $user->initial }}</span>
                            @endif
                        </div>
                        <input type="file" name="avatar" class="form-control" placeholder="Avatar">
                        <small class="form-text text-muted">Optional.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" placeholder="Name" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" placeholder="Email" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">No Whatsapp *</label>
                        <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror"
                        value="{{ old('telp', $user->telp) }}" placeholder="No Whatsapp" required>
                        @error('telp')
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
