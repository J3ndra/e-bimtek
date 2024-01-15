@extends('team.layout.main')
@section('title', 'Update Pembelajaran: ' . $lesson->title . ' - ' . $lesson->course->title)
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
<x-breadcumb title="Bimtek" sub="Update Pembelajaran: {{ $lesson->title }} - {{ $lesson->course->title }}" />
<div class="container page__container page-section">
    <form method="POST" action="{{ route('team.lessons.update', [$lesson->course_id, $lesson->id]) }}"
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
                        value="{{ old('title', $lesson->title) }}" placeholder="Judul Pembelajaran">
                    @error('title')
                    <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" form-group mb-32pt">
                    <label class="form-label">Deskripsi</label>
                    <input name="description" type="hidden">
                    <div class="@error('description') is-invalid @enderror" id="description" style="height: 320px;">
                        {!! old('description', $lesson->description) !!}
                    </div>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header text-center">
                        <button type="submit" class="btn btn-accent">Update</button>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Tanggal</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <label class="form-label" for="date">Pembelajaran Dibuka:</label>
                        <input id="date" type="text" name="date" class="form-control" placeholder="Pembelajaran Dibuka"
                            data-toggle="daterangepicker" data-daterangepicker-drops="up"
                            data-daterangepicker-start-date="{{ now()->format('Y/m/d') }}"
                            data-daterangepicker-single-date-picker="true" value="{{ $lesson->date->format('Y/m/d') }}">
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
