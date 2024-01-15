@extends('admin.layout.main')
@section('title', 'Edit Slider')
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
    <form method="POST" action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data" id="form-page">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-8">

                <div class="page-separator">
                    <div class="page-separator__text">Lengkapi Form Dibawah Dengan Benar</div>
                </div>

                <label class="form-label">Nama*</label>
                <div class="form-group mb-24pt">
                    <input type="text" name="name"
                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                    value="{{ old('name') ?? $slider->name }}" placeholder="Judul Slider">
                    @error('name')
                    <div class=" invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <label class="form-label">Gambar</label>
                <div class="form-group mb-24pt">
                    <input type="file" id="picture" name="picture"
                    class="form-control form-control-lg @error('picture') is-invalid @enderror"
                    value="{{ old('picture') }}" placeholder="Masukkan gambar slider">
                    <small>Pilih untuk mengganti</small>
                    @error('picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header text-center">
                        <button type="submit" class="btn btn-accent">Save</button>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Preview</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <img id="preview" src="https://via.placeholder.com/1024x512" class="w-100" alt="">
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
    $(document).ready(function() {
        $('#picture').on('change', function() {
            var preview = document.getElementById('preview');
            var file    = document.getElementById('picture').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        });
    });

</script>
@endsection
