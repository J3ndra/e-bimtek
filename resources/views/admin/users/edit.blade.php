@extends('admin.layout.main')
@section('title', 'Edit Data User: ' . $user->name)
@section('content')
<x-breadcumb title="Data User" sub="Edit Data User: {{ $user->name }}" />
  <div class="container page__container page-section">
    <div class="page-separator">
      <div class="page-separator__text">Edit Data User: {{ $user->name }}</div>
    </div>
    <div class="col-md-6 p-0">
      <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label class="form-label">Avatar</label>
          <div class="clearfix"></div>
          <div class="avatar avatar-xl mb-2">
            @if($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="avatar-img rounded-circle">
            @else
            <span class="avatar-title rounded">{{ $user->initial }}</span>
            @endif
          </div>
          <input type="file" name="avatar" class="form-control" placeholder="Avatar">
          <small class="form-text text-muted">Kosongkan bila tidak ingin mengubah avatar.</small>
        </div>

        <div class="form-group">
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Name" required>
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Email *</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Email" required>
          @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Whatsapp *</label>
          <input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp', $user->telp) }}" placeholder="Whatsapp" required>
          @error('telp')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" minlength="6">
          @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <small class="form-text text-muted">Kosongkan bila tidak ingin mengubah password.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  @endsection