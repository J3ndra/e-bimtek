@extends('admin.layout.main')
@section('title', 'Tambah Data User')
@section('content')
<x-breadcumb title="Data User" sub="Tambah Data User" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Tambah Data User</div>
	</div>
	<div class="col-md-6 p-0">
		<form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label class="form-label">Avatar</label>
				<input type="file" name="avatar" class="form-control" placeholder="Avatar">
				<small class="form-text text-muted">Optional.</small>
			</div>

			<div class="form-group">
				<label class="form-label">Name *</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" required>
				@error('name')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label class="form-label">Email *</label>
				<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
				@error('email')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label class="form-label">Whatsapp *</label>
				<input type="number" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp', '62') }}" placeholder="Whatsapp" required>
				@error('telp')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label class="form-label">Password *</label>
				<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" minlength="6" required>
				@error('password')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
@endsection