@extends('team.layout.main')
@section('title', 'Edit Kuis: ' . $quiz->title)
@section('styles')
<!-- Quill Theme -->
<link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
<!-- Select2 -->
<link type="text/css" href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
<!-- DateRangePicker -->
<link type="text/css" href="{{ asset('vendor/daterangepicker.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Kuis" sub="Edit Kuis: {{ $quiz->title }}" />
<div class="container page__container">
    <div class="row align-items-start">
        <div class="col-md-8">

            <div class="page-separator">
                <div class="page-separator__text">Pertanyaan</div>
            </div>

            @if(session('message'))
            <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
            @endif

            <a href="{{ route('team.questions.create', $quiz->id) }}"
                class="btn btn-outline-secondary mb-24pt mb-3">Tambah Pertanyaan</a>

            @if($quiz->questions()->count())
            <ul class="list-group stack mb-40pt">
                @foreach($quiz->questions()->get() as $question)
                <li class="list-group-item d-flex">
                    <i class="material-icons text-70 icon-16pt icon--left">drag_handle</i>
                    <div class="flex d-flex flex-column">
                        <div class="card-title mb-4pt">Pertanyaan {{ $loop->iteration }} dari {{ $loop->count }}
                        </div>
                        <div class="card-subtitle text-70 paragraph-max mb-16pt">
                            {!! $question->question !!}
                            <p>
                                <ul>
                                    @foreach(json_decode($question->selection) as $selection)
                                    <li>{{ $selection->alphabet }}. {{ $selection->value }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                        <div>
                            <div class="chip chip-outline-secondary">Jawaban: {{ $question->answer }}</div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i
                                class="material-icons">more_horiz</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('team.questions.edit', [$quiz->id, $question->id]) }}"
                                class="dropdown-item">Edit</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST"
                                action="{{ route('team.questions.destroy', [$quiz->id, $question->id]) }}"
                                class="d-inline form-delete">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
            @endif

        </div>

        <div class="col-md-4">
            <form method="POST" action="{{ route('team.quizzes.update', $quiz->id) }}" enctype="multipart/form-data"
                id="form-page">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header text-center">
                        <button type="submit" class="btn btn-accent mt-2">Simpan</button>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Detail</div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Judul *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $quiz->title) }}" placeholder="Judul" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jumlah Soal *</label>
                            <input type="number" name="amount"
                                class="form-control @error('amount') is-invalid @enderror"
                                value="{{ old('amount', $quiz->amount) }}" placeholder="Jumlah Soal" required>
                            @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">KKM *</label>
                            <input type="number" name="min" class="form-control @error('min') is-invalid @enderror"
                                value="{{ old('min', $quiz->min) }}" placeholder="KKM" required>
                            @error('min')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bimtek</label>
                            <select name="course_id"
                                class="form-control custom-select @error('course_id') is-invalid @enderror"
                                data-toggle="select">
                                <option selected disabled>== PILIH ==</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $course->id == old('course_id', $quiz->course_id) ? 'selected' : '' }}>
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
                                <option {{ old('type', $quiz->type) == 'Pre Test' ? 'selected' : '' }}>
                                    Pre Test</option>
                                <option {{ old('type', $quiz->type) == 'Post Test' ? 'selected' : '' }}>
                                    Post Test</option>
                            </select>
                            <small class="form-text text-muted">[Pilih salah satu tipe].</small>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<!-- Select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
@endsection
