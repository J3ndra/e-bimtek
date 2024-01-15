@extends('admin.layout.main')
@section('title', 'Tambah Data Kategori')
@section('content')
<x-breadcumb title="Data Kategori" sub="Tambah Data Kategori" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Tambah Data Kategori</div>
	</div>
	<div class="col-md-6 p-0">
		<form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
			@csrf

			<div class="form-group">
				<label class="form-label">Icon *</label>
				<input type="file" name="icon" class="form-control" placeholder="Icon" required>
				@error('icon')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label class="form-label">Name *</label>
				<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" required>
				@error('name')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
@endsection