@extends('user.layout.main')
@section('title', 'Pertanyaan')
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-8pt">Pertanyaan</h1>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">

                    <p class="lead measure-lead text-70 mb-24pt">
                        {!! $answer->question->question !!}
                    </p>

                    <div class="page-separator">
                        <div class="page-separator__text">Jawaban</div>
                    </div>
                    @foreach(json_decode($answer->question->selection) as $selection)
                    <div class="form-group">
                        <div class="custom-control">
                            <input id="{{ $selection->alphabet }}" type="radio" name="answer"
                                value="{{ $selection->alphabet }}" class="custom-control-input"
                                {{ $selection->alphabet == $answer->answer ? 'checked' : '' }}>
                            <label for="{{ $selection->alphabet }}"
                                class="custom-control-label">{{ $selection->alphabet }}. {{ $selection->value }}</label>
                        </div>
                    </div>
                    @endforeach

                    <p class="text-50 mb-0">Note: Semangat ^_^.</p>

                </div>
                <div class="col-lg-4">

                    <div class="d-flex flex-column mb-24pt">
                        @if($previous)
                        <a href="{{ route('quiz.question', [$answer->quiz->id, $previous]) }}"
                            class="btn justify-content-center btn-outline-secondary mb-16pt">Sebelumnya</a>
                        @endif
                        @if($next)
                        <a href="{{ route('quiz.question', [$answer->quiz->id, $next]) }}"
                            class="btn justify-content-center btn-accent ">Next Question <i
                                class="material-icons icon--right">keyboard_arrow_right</i></a>
                        @else
                        <form action="{{ route('quiz.finish', $answer->quiz->id) }}" method="POST">
                            @csrf

                            <button type="submit" id="finish" class="btn justify-content-center btn-accent " hidden>Selesai <i
                                    class="material-icons icon--right">keyboard_arrow_right</i></a>
                        </form>
                        @endif
                    </div>

                    <div class="page-separator">
                        <div class="page-separator__text">Course</div>
                    </div>

                    <a href="javascript:void(0);" class="d-flex flex-nowrap mb-24pt">
                        <span class="mr-16pt">
                            <img src="{{ Storage::url($answer->quiz->course->thumbnail) }}" width="40" class="rounded">
                        </span>
                        <span class="flex d-flex flex-column align-items-start">
                            <span class="card-title">{{ $answer->quiz->course->title }}</span>
                        </span>
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('input:radio[name="answer"]').change(
        function () {
            if ($(this).is(':checked')) {
                let answer = $(this).val();

                $.ajax({
                    url: '{{ route('quiz.answer', [$answer->quiz->id, $answer->id]) }}',
                    type: 'PATCH',
                    data: {
                        _token: "{{ csrf_token() }}",
                        answer: answer,
                        _method: "PATCH"
                    },
                    success: function (res) {
                        console.log(res);
                        if(res == true){
                            $('#finish').attr('hidden', false);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });

</script>
@endsection
