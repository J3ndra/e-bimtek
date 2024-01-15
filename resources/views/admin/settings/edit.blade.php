@extends('admin.layout.main')
@section('title', 'Edit Pengaturan: ' . $setting->title)
@section('content')
<x-breadcumb title="Pengaturan" sub="Edit Pengaturan: {{ $setting->title }}" />
  <div class="container page__container page-section">
    <div class="page-separator">
      <div class="page-separator__text">Edit Pengaturan: {{ $setting->title }}</div>
    </div>
    <div class="col-md-6 p-0">
      <form method="POST" action="{{ route('admin.settings.update', $setting->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label class="form-label">Slug *</label>
          <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $setting->slug) }}" placeholder="Slug" required>
          @error('slug')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">Title *</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $setting->title) }}" placeholder="Title" required>
          @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Value *</label>
            @if($setting->type == 'file')
            <input type="file" name="value" class="form-control @error('value') is-invalid @enderror" placeholder="Value" required>
            @else
            <textarea name="value" class="form-control @error('value') is-invalid @enderror" placeholder="Value" required>{{ old('value', $setting->value) }}</textarea>
            @endif
            @error('value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  @endsection
