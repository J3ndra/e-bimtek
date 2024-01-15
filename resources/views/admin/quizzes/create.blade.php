@extends('admin.layout.main')
@section('title', 'Tambah Data Quiz')
@section('styles')
<!-- Select2 -->
<link type="text/css" href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Data Quiz" sub="Tambah Data Quiz" />
<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Tambah Data Quiz</div>
    </div>

    @if(session('message'))
    <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif

    <div class="col-md-6 p-0">
        <form method="POST" action="{{ route('admin.quizzes.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Judul *</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" placeholder="Judul" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Soal *</label>
                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"
                value="{{ old('amount') }}" placeholder="Jumlah Soal" required>
                @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">KKM *</label>
                <input type="number" name="min" class="form-control @error('min') is-invalid @enderror"
                value="{{ old('min') }}" placeholder="KKM" required>
                @error('min')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Bimtek</label>
                <select name="course_id" class="form-control custom-select @error('course_id') is-invalid @enderror"
                data-toggle="select">
                <option selected disabled>== PILIH ==</option>
                @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ $course->id == old('course_id') ? 'selected' : '' }}>
                    {{ $course->title }} | {{ $course->team->name ?? '-' }}
                </option>
                @endforeach
            </select>
            <small class="form-text text-muted">[Pilih salah satu Bimtek].</small>
            @error('course_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Tipe Kuis</label>
            <select name="type" class="form-control custom-select @error('type') is-invalid @enderror">
                <option selected disabled>== PILIH ==</option>
                <option {{ old('type') == 'Pre Test' ? 'selected' : '' }}>
                Pre Test</option>
                <option {{ old('type') == 'Post Test' ? 'selected' : '' }}>
                Post Test</option>
            </select>
            <small class="form-text text-muted">[Pilih salah satu tipe].</small>
            @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
@endsection
@section('scripts')
<!-- Select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
@endsection
