@extends('admin.layout.main')
@section('title', 'Edit Data Kategori: ' . $category->name)
@section('content')
<x-breadcumb title="Data Kategori" sub="Edit Data Kategori: {{ $category->name }}" />
  <div class="container page__container page-section">
    <div class="page-separator">
      <div class="page-separator__text">Edit Data Kategori: {{ $category->name }}</div>
    </div>
    <div class="col-md-6 p-0">
      <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label class="form-label">Icon</label>
          <div class="clearfix"></div>
          <div class="avatar avatar-xl mb-2">
            <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" class="avatar-img rounded-circle">
          </div>
          <input type="file" name="icon" class="form-control" placeholder="Icon">
          <small class="form-text text-muted">Kosongkan bila tidak ingin mengubah icon.</small>
        </div>

        <div class="form-group">
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" placeholder="Name" required>
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  @endsection