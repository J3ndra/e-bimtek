@extends('team.layout.main')
@section('title', 'Edit Sub Pembelajaran: ' . $subLesson->title)
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
<x-breadcumb title="Page" sub="Edit Sub Pembelajaran: {{ $subLesson->title }}" />
<div class="container page__container page-section">
    <form method="POST"
        action="{{ route('team.sublessons.update', [$subLesson->lesson->course->id, $subLesson->lesson->id, $subLesson->id]) }}"
        enctype="multipart/form-data" id="form-page">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-md-8">

                <div class="page-separator">
                    <div class="page-separator__text">Lengkapi Form Dibawah Dengan Benar ^_^</div>
                </div>

                <label class="form-label">Judul</label>
                <div class="form-group mb-24pt">
                    <input type="text" name="title"
                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                        value="{{ old('title', $subLesson->title) }}" placeholder="Judul Sub Pembelajaran">
                    @error('title')
                    <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" form-group mb-32pt">
                    <label class="form-label">Deskripsi</label>
                    <input name="description" type="hidden">
                    <div class="@error('description') is-invalid @enderror" id="description" style="height: 320px;">
                        {!! old('description', $subLesson->description) !!}
                    </div>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header text-center">
                        <button type="submit" class="btn btn-accent">Edit</button>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Konten</div>
                </div>

                <div class="card">
                    @if($subLesson->video)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $subLesson->video }}" allowfullscreen=""></iframe>
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option selected disabled>== PILIH ==</option>
                                <option value="video" {{ old('video', $subLesson->video) ? 'selected' : '' }}>Video
                                </option>
                                <option value="pdf" {{ old('pdf', $subLesson->pdf) ? 'selected' : '' }}>PDF</option>
                            </select>
                        </div>
                        <div class="form-group" id="video"
                            style="{{ old('video', $subLesson->video) ? '' : 'display: none' }};">
                            <label class="form-label">Video</label>
                            <input type="text" name="video" class="form-control @error('video') is-invalid @enderror"
                                value="{{ old('video', $subLesson->video) }}">
                            @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" id="pdf"
                            style="{{ old('pdf', $subLesson->pdf) ? '' : 'display: none' }};">
                            @if($subLesson->pdf)
                            <a href="{{ Storage::url($subLesson->pdf) }}"
                                class="btn btn-primary mb-2">{{ basename($subLesson->pdf) }}</a><br>
                            @endif
                            <label class="form-label">PDF</label>
                            <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror">
                            @error('pdf')
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
                            <label class="form-label">Durasi</label>
                            <input type="text" name="duration"
                                class="form-control @error('duration') is-invalid @enderror"
                                value="{{ old('duration', $subLesson->duration) }}"
                                placeholder="Masukkan durasi Bimtek">
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

    $(document).on('change', '#type', function () {
        let value = $(this).val();

        if (value == 'pdf') {
            $('#pdf').show();
            $('#video').hide();
            $('input[name=video]').val('');
        } else {
            $('#video').show();
            $('#pdf').hide();
            $('input[name=pdf]').val('');
        }
    });

</script>
@endsection
