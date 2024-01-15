@extends('user.layout.main')
@section('title', 'Hasil Skor Kuis')
@section('content')
<div class="mdk-header-layout__content page-content ">
    <div class="navbar navbar-list navbar-light bg-white border-bottom-2 border-bottom navbar-expand-sm"
        style="white-space: nowrap;">
        <div class="container page__container">
            <nav class="nav navbar-nav">
                <div class="nav-item navbar-list__item">
                    <a href="{{ route('course', $score->quiz->course->slug) }}" class="nav-link h-auto"><i
                            class="material-icons icon--left">keyboard_backspace</i> Kembali ke Bimtek</a>
                </div>
                <div class="nav-item navbar-list__item">
                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="mr-16pt">
                            <a href="{{ route('course', $score->quiz->course->slug) }}"><img src="{{ Storage::url($score->quiz->course->thumbnail) }}"
                                    width="40" alt="{{ $score->quiz->course->title }}" class="rounded"></a>
                        </div>
                        <div class="flex">
                            <a href="{{ route('course', $score->quiz->course->slug) }}" class="card-title text-body mb-0">{{ $score->quiz->course->title }}</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0" data-effects="blend-background">
        <div class="mdk-box__content">
            <div class="py-64pt text-center text-sm-left">
                <div class="container d-flex flex-column justify-content-center align-items-center">
                    <h1 class="text-white mb-24pt">Skor Hasil: {{ $score->score }} (KKM: {{ $score->quiz->min }})</h1>
                    @if($score->quiz->type == 'Pre Test')
                    <p class="lead text-white-50 measure-lead-max mb-0">
                        @if($score->score >= $score->quiz->min)
                        Selamat anda lulus dan bisa membeli Bimtek ini.
                        @else
                        Maaf, anda tidak lulus dan tidak bisa membeli Bimtek ini. Coba lagi.
                        @endif
                        <br>Diselesaikan pada tanggal {{ $score->created_at->format('d F Y H:i') }}
                    </p>
                    @else
                    <p class="lead text-white-50 measure-lead-max mb-0">
                        @if($score->score >= $score->quiz->min)
                        Selamat telah lulus dalam mengikuti Bimtek ini.
                        @else
                        Maaf, anda belum lulus. Coba lagi.
                        @endif
                        <br>Diselesaikan pada tanggal {{ $score->created_at->format('d F Y H:i') }}
                    </p>
                    @endif

                    @if($score->score >= $score->quiz->min && $score->quiz->type == 'Post Test')
                    <form action="{{ route('certificate', $score->quiz->course->slug) }}" method="POST" class="d-inline">
                                    @csrf

                                    <button type="submit" class="btn btn-outline-white mt-3">Download Sertifikat
                                    <i class="material-icons icon--right">play_circle_outline</i></button>
                                </form>
                    @endif
                    <a href="{{ route('course', $score->quiz->course->slug) }}" class="btn btn-outline-white mt-3">Kembali ke Bimtek</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
