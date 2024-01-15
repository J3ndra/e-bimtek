@extends('team.layout.main')
@section('title', 'Data Akun: ' . $team->name)
@section('content')
<x-breadcumb title="Account" sub="Data Akun: {{ $team->name }}" />
<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Data Akun: {{ $team->name }}</div>
    </div>
    @if(session('message'))
    <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif
    <div class="col-md-6 p-0">
        <form method="POST" action="{{ route('team.account.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label class="form-label">Avatar</label>
                <div class="clearfix"></div>
                <div class="avatar avatar-xl mb-2">
                    @if($team->avatar)
                    <img src="{{ Storage::url($team->avatar) }}" alt="{{ $team->name }}"
                        class="avatar-img rounded-circle">
                    @else
                    <span class="avatar-title rounded">{{ $team->initial }}</span>
                    @endif
                </div>
                <input type="file" name="avatar" class="form-control" placeholder="Avatar">
                <small class="form-text text-muted">Optional.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $team->name) }}" placeholder="Name" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $team->email) }}" placeholder="Email" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
