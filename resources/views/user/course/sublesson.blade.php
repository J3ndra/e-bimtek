@extends('user.layout.main')
@section('title', $subLesson->title)
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="avatar mb-16pt mb-md-0 mr-md-16pt">
                        <img src="{{ Storage::url($subLesson->lesson->course->thumbnail) }}" class="avatar-img rounded"
                            alt="lesson">
                    </div>
                    <div class="flex">
                        <h1 class="h2 m-0">{{ $subLesson->lesson->course->title }}</h1>
                        <div class="rating mb-8pt d-inline-flex">
                            @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                <span class="material-icons">
                                    {{ $subLesson->lesson->course->stars <= $i ? 'star_border' : 'star' }}
                                </span>
                                </span>
                                @endfor
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-primary pb-lg-64pt py-32pt">
        <div class="container page__container">
            <nav class="course-nav">
                @foreach($subLessons as $sub)
                <a data-toggle="tooltip" data-placement="bottom" data-title="{{ $sub->title }}"
                    href="{{ route('sublesson', [$subLesson->lesson->course->slug, $subLesson->lesson->id, $sub->id]) }}"><span
                        class="material-icons {{ $subLesson->id == $sub->id ? 'text-primary' : '' }}">play_arrow</span></a>
                @endforeach
            </nav>
            @if($subLesson->video)
            <div class="js-player embed-responsive embed-responsive-16by9 mb-32pt">
                <div class="player embed-responsive-item">
                    <div class="player__content">
                        <div class="player__image"
                            style="--player-image: url({{ Storage::url($subLesson->lesson->course->thumbnail) }})">
                        </div>
                        <a href="" class="player__play bg-primary">
                            <span class="material-icons">play_arrow</span>
                        </a>
                    </div>
                    <div class="player__embed">
                        <iframe class="embed-responsive-item" src="{{ $subLesson->video }}" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
            @endif

            <div class="d-flex flex-wrap align-items-end mb-16pt">
                <h1 class="text-white flex m-0">{{ $subLesson->title }}</h1>
                <p class="h1 text-white-50 font-weight-light m-0">{{ $subLesson->duration }}</p>
            </div>

            <div class="hero__lead measure-hero-lead text-white-50 mb-24pt">
                {!! $subLesson->description !!}
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
                @if($subLesson->pdf)
                <a href="{{ Storage::url($subLesson->pdf) }}"
                    class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">Download Materi Bimtek <i
                        class="material-icons icon--right">play_circle_outline</i></a>
                @endif

                <a href="{{ route('course', $subLesson->lesson->course->slug) }}"
                    class="btn btn-outline-white mb-16pt mb-sm-0 mr-sm-16pt">Kembali ke Bimtek <i
                        class="material-icons icon--right">play_circle_outline</i></a>
            </div>
            <div id="disqus_thread"></div>
        </div>
    </div>
</div>

</div>
@endsection
