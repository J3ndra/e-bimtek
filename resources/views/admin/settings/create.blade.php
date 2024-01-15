@extends('admin.layout.main')
@section('title', 'Tambah Pengaturan: ')
@section('content')
<x-breadcumb title="Pengaturan" sub="Tambah Pengaturan" />
  <div class="container page__container page-section">
    <div class="page-separator">
      <div class="page-separator__text">Tambah Pengaturan</div>
    </div>
    <div class="col-md-6 p-0">
      <form method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label class="form-label">Slug *</label>
          <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="Slug" required>
          <small>available slug : f_link</small>
          @error('slug')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Title *</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Title" required>
          @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Value *</label>
            <textarea name="value" class="form-control @error('value') is-invalid @enderror" placeholder="Value" required>{{ old('value') }}</textarea>
            @error('value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  @endsection
