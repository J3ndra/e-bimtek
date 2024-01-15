@extends('admin.layout.main')
@section('title', 'Tambah Pertanyaan: ' . $quiz->title)
@section('styles')
<!-- Quill Theme -->
<link type="text/css" href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Bimtek" sub="Tambah Pertanyaan: {{ $quiz->title }}" />
<div class="container page__container page-section">
    <form method="POST" action="{{ route('admin.questions.store', $quiz->id) }}" enctype="multipart/form-data"
        id="form-page">
        @csrf

        <div class="row">
            <div class="col-md-7">

                <div class="page-separator">
                    <div class="page-separator__text">Lengkapi Form Dibawah Dengan Benar ^_^</div>
                </div>

                <div class=" form-group mb-32pt">
                    <label class="form-label">Pertanyaan</label>
                    <input name="question" type="hidden">
                    <div class="@error('question') is-invalid @enderror" id="question" style="height: 320px;">
                        {!! old('question') !!}
                    </div>
                    @error('question')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header text-center">
                        <button type="submit" class="btn btn-accent">Tambah</button>
                    </div>
                </div>

                <div class="page-separator">
                    <div class="page-separator__text">Pilihan Ganda</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Pilihan Jawaban</label>
                            <div class="form-group mb-24pt">
                                <div class="col-sm-10 repeater">
                            <div data-repeater-list="selection">
                                <div data-repeater-item class="row">
                                    <div class="form-group col-md-3">
                                        <label for="label">Alphabet</label>
                                        <input type="text" id="label" name="alphabet" class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="value">Jawaban</label>
                                        <input type="text" id="value" name="value" class="form-control" required />
                                    </div>

                                    <div class="col-md-3 align-self-center">
                                        <input data-repeater-delete type="button" class="btn btn-primary mt-2"
                                            value="Hapus" />
                                    </div>
                                </div>
                            </div>
                            <input data-repeater-create type="button" class="btn btn-success mt-2" value="Tambah" />
                        </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jawaban benar (alphabet)</label>
                            <div class="form-group mb-24pt">
                                <input type="text" name="answer"
                                    class="form-control @error('answer') is-invalid @enderror"
                                    value="{{ old('answer') }}" placeholder="Jawaban benar">
                                @error('answer')
                                <div class=" invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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

<!-- Repeater -->
<script src="{{ asset('vendor/jquery-repeater.min.js') }}"></script>
<script src="{{ asset('js/repeater.js') }}"></script>

<script type="text/javascript">
    const quill = new Quill('#question', {
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
        const question = document.querySelector('input[name=question]');
        question.value = quill.root.innerHTML;

        console.log("Submitted", $(this).serialize(), $(this).serializeArray());
    });

</script>
@endsection
