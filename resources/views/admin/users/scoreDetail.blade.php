@extends('admin.layout.main')

@section('title', 'Data User')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
{{-- <x-breadcumb title="Data User" /> --}}

<div class="navbar navbar-list navbar-light bg-white border-bottom-2 border-bottom navbar-expand-sm"
                     style="white-space: nowrap;">
    <div class="container page__container">
        <nav class="nav navbar-nav">
            <div class="nav-item navbar-list__item">
                <a href="student-take-course.html"
                    class="nav-link h-auto"><i class="material-icons icon--left">keyboard_backspace</i> Back to User</a>
            </div>
            <div class="nav-item navbar-list__item">
                <div class="d-flex align-items-center flex-nowrap">
                    <div class="mr-16pt">
                        <a href="student-take-course.html"><img src="{{ Storage::url($score->quiz->course->thumbnail) }}"
                                    width="40"
                                    alt="{{ $score->quiz->course->title }}"
                                    class="rounded"></a>
                    </div>
                    <div class="flex">
                        <a href="student-take-course.html"
                            class="card-title text-body mb-0">{{ $score->quiz->course->title }}</a>
                        <p class="lh-1 d-flex align-items-center mb-0">
                            <span class="text-50 small font-weight-bold mr-8pt">{{ $score->user->name }}</span>
                            <span class="text-50 small">{{ $score->quiz->course->category->name }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0"
        data-effects="blend-background">
    <div class="mdk-box__content">
        <div class="py-64pt text-center text-sm-left">
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <p class="lead text-white-50 measure-lead-max mb-0">Diserahkan pada {{ $score->created_at->format('d M Y') }}</p>
                <h1 class="text-white mb-24pt">Nilai Anda: {{ $score->score }}</h1>
                <a href="#answer"
                    class="btn btn-outline-white">Analisis Jawaban</a>
            </div>
        </div>
    </div>
</div>

<div class="navbar navbar-expand-sm navbar-light navbar-submenu navbar-list p-0 m-0 align-items-center" id="answer">
    <div class="container page__container">
        <ul class="nav navbar-nav flex align-items-sm-center">
            <li class="nav-item navbar-list__item">Nilai {{ $score->score }}/100</li>
            <li class="nav-item navbar-list__item">
                <i class="material-icons text-muted icon--left">assessment</i>
                {{ $question_count }} Soal
            </li>
        </ul>
    </div>
</div>

<div class="container page__container">

    @foreach ( $score->quiz->questions as $question )
    @php
        $answer = $score->answer($question->id);
        $status = $question->answer == $answer->answer ? 'Pass' : 'Fail';
    @endphp
    <div class="border-left-2 page-section pl-32pt">

        <div class="d-flex align-items-center page-num-container mb-16pt">
            <div class="page-num">{{ $loop->iteration }}</div>
            <h4>Soal pertanyaan {{ $loop->iteration }} dari {{ $question_count }} <span class="badge badge-{{ $status == 'Pass' ? 'success' : 'danger' }}">{{ $status . ': ' . $question->answer}}</span></h4>
        </div>

        <p class="text-70 measure-lead mb-32pt mb-lg-48pt">{!! $question->question !!}</p>

        <ul class="list-quiz">
            @foreach(json_decode($question->selection) as $selection)
            <li class="list-quiz-item">
                @if ($selection->alphabet == $answer->answer)
                <span class="list-quiz-badge bg-primary text-white"><i class="material-icons">check</i></span>
                @else
                <span class="list-quiz-badge">{{ $selection->alphabet }}</span>
                @endif
                <span class="list-quiz-text">{{ $selection->value }}</span>
            </li>
            @endforeach
        </ul>

    </div>
    @endforeach

</div>
@endsection

@section('scripts')
<!-- List.js -->
<script src="{{ asset('vendor/list.min.js') }}"></script>
<script src="{{ asset('js/list.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.score-list').on('click', function() {
            var e = $(this)[0];
            $.ajax({
                type: "POST",
                url: `{{ route('admin.users.score') }}/${e.dataset.id}`,
                cache: false,
                success: function(response){
                    $('.scoreSegment').attr('hidden', false);
                    var t = $('#scoreTable');
                    t.empty();
                    $.each(response, function(key,val) {
                        t.append(`
                        <tr>
                            <td>${key + 1}</td>
                            <td>${val.quiz.title}</td>
                            <td>${val.quiz.course.title}</td>
                            <td>${val.quiz.type}</td>
                            <td>${val.score}</td>
                            <td>` + (function() {
                                if(val.quiz.min <= val.score) {
                                    return `Lulus`;
                                }else {
                                    return `Tidak Lulus`;
                                }
                            })()
                            + `</td>
                        </tr>
                        `);
                    });
                }
            });
        })
    })
</script>
@endsection
