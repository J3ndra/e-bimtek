@extends('admin.layout.main')
@section('title', 'Tambah Bimtek')
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
<x-breadcumb title="Page" sub="Tambah Bimtek" />
<div class="container page__container page-section">
    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" id="form-page">
        @csrf

        <div class="row">
            <div class="col-md-8">

                <div class="page-separator">
                    <div class="page-separator__text">Lengkapi Form Dibawah Dengan Benar ^_^</div>
                </div>

                <label class="form-label">Judul</label>
                <div class="form-group mb-24pt">
                    <input type="text" name="title"
                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" placeholder="Judul Bimtek">
                    @error('title')
                    <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" form-group mb-32pt">
                    <label class="form-label">Deskripsi</label>
                    <input name="description" type="hidden">
                    <div class="@error('description') is-invalid @enderror" id="description" style="height: 320px;">
                        {!! old('description') !!}
                    </div>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header text-center">
                        <button type="submit" class="btn btn-accent">Save as Draft</button>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Pelaksanaan</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="date-course">Tanggal Bimtek</label>
                            <input id="date_course" type="text" name="date_course"
                            class="form-control form-control-md @error('date_course') is-invalid @enderror"
                            placeholder="Pelaksanaan Bimtek" data-toggle="daterangepicker"
                            data-daterangepicker-drops="up"
                            data-daterangepicker-start-date="{{ old('date_course') ? daterange(old('date_course'), 'start', 'Y/m/d') : now()->format('Y/m/d') }}"
                            data-daterangepicker-end-date="{{ old('date_course') ? daterange(old('date_course'), 'end', 'Y/m/d') : now()->addDays(7)->format('Y/m/d') }}">
                            @error('date_course')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="team_id">Tim</label>
                            <select id="team_id" name="team_id" data-toggle="select" class="form-control">
                                <option selected disabled>>> PILIH TEAM <<</option>
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Trailer</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail"
                            class="form-control @error('thumbnail') is-invalid @enderror"
                            value="{{ old('thumbnail') }}" placeholder="Masukkan thumbnail Bimtek">
                            @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Video</label>
                            <input type="text" name="trailer"
                            class="form-control @error('trailer') is-invalid @enderror" value="{{ old('trailer') }}"
                            placeholder="Masukkan trailer Bimtek">
                            @error('trailer')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Tambahan</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Design</label>
                            <select name="design_id"
                            class="form-control custom-select @error('design_id') is-invalid @enderror">
                            <option selected disabled>== PILIH ==</option>
                            <option value="0"
                            {{ 0 == old('design_id') ? 'selected' : '' }}>
                                Tanpa Sertifikat
                            </option>
                            @foreach($designs as $design)
                            <option value="{{ $design->id }}"
                                {{ $design->id == old('design_id') ? 'selected' : '' }}>
                                {{ $design->name }}
                            </option>
                            @endforeach
                            </select>
                            <small class="form-text text-muted">[Pilih salah satu desain sertifikat].</small>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select name="category_id"
                            class="form-control custom-select @error('category_id') is-invalid @enderror">
                            <option selected disabled>== PILIH ==</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">[Pilih salah satu kategori].</small>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Harga</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group form-inline">
                                        <span class="input-group-prepend"><span
                                            class="input-group-text">Rp</span></span>
                                            <input type="number" name="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price') }}">
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Durasi</label>
                                <input type="text" name="duration"
                                class="form-control @error('duration') is-invalid @enderror"
                                value="{{ old('duration') }}" placeholder="Masukkan durasi Bimtek">
                                @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
    @endsection
    @section('scripts')
    <!-- Quill -->
    <script src="{{ asset('vendor/quill.min.js') }}"></script>
    <script src="{{ asset('js/quill.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <!-- DateRangePicker -->
    <script src="{{ asset('vendor/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        const quill = new Quill('#description', {
            modules: {
                toolbar: [
                ['bold', 'italic'],
                ['link', 'blockquote', 'code-block', 'image'],
                [{
                    list: 'ordered'
                }, {
                    list: 'bullet'
                }]
                ]
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        });

        $(document).on('submit', '#form-page', function () {
            const description = document.querySelector('input[name=description]');
            description.value = quill.root.innerHTML;

            console.log("Submitted", $(this).serialize(), $(this).serializeArray());
        });

    </script>
    @endsection
