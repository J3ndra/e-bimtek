@extends('admin.layout.main')
@section('title', 'Edit Data Channel Pembayaran: ' . $channel->name)
@section('content')
<x-breadcumb title="Data Channel Pembayaran" sub="Edit Data Channel Pembayaran: {{ $channel->name }}" />
  <div class="container page__container page-section">
    <div class="page-separator">
      <div class="page-separator__text">Edit Data Channel Pembayaran: {{ $channel->name }}</div>
    </div>
    <div class="col-md-6 p-0">
      <form method="POST" action="{{ route('admin.channels.update', $channel->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label class="form-label">Name *</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $channel->name) }}" placeholder="Name" required>
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="status">Status</label><br>
          <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
            <input checked type="checkbox" name="status" id="status" class="custom-control-input">
            <label class="custom-control-label" for="status">Aktif</label>
          </div>
          <label class="form-label mb-0" for="status">Aktif</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  @endsection