@extends('team.layout.main')
@section('title', 'Bimtek')
@section('content')
<x-breadcumb title="Bimtek" />
<div class="container page__container page-section">

    <div class="page-separator">
        <div class="page-separator__text">Semua Bimtek</div>
    </div>

        @if(session('message'))
        <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
        @endif

        <div class="row">
            @foreach($courses as $course)
            <div class="col-sm-6 col-md-4 col-xl-3">

                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary js-overlay mdk-reveal js-mdk-reveal "
                data-partial-height="44" data-toggle="popover" data-trigger="click">
                <a href="{{ route('team.courses.edit', $course->id) }}" class="js-image" data-position="left">
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}" width="430" height="168">
                    <span class="overlay__content align-items-start justify-content-start">
                        <span class="overlay__action card-body d-flex align-items-center">
                            <i class="material-icons mr-4pt">edit</i>
                            <span class="card-title text-white">Edit</span>
                        </span>
                    </span>
                </a>
                <div class="mdk-reveal__content">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title mb-4pt" href="{{ route('course', $course->slug) }}">{{ $course->title }}</a>
                            </div>
                            <a href="{{ route('team.courses.edit', $course->id) }}"
                                class="ml-4pt material-icons text-20 card-course__icon-favorite">edit</a>
                            </div>
                            <div class="d-flex">
                                <div class="rating flex">
                                    @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                        <span class="material-icons">{{ $course->stars <= $i ? 'star_border' : 'star' }}</span>
                                    </span>
                                    @endfor
                                </div>
                                <small class="text-50">{{ $course->duration }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="{{ Storage::url($course->thumbnail) }}" width="40" height="40"
                            alt="{{ $course->title }}" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title mb-0">{{ $course->title }}</div>
                        </div>
                    </div>

                    <p class="my-16pt text-70">{{ Str::limit(strip_tags($course->description), 62, ' [...]') }}</p>

                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="d-flex align-items-center mb-4pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                <p class="flex text-50 lh-1 mb-0"><small>{{ $course->duration ?? '-' }}</small></p>
                            </div>
                            <div class="d-flex align-items-center mb-4pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-50 lh-1 mb-0"><small>{{ $course->lessons()->count() }} pembelajaran</small></p>
                            </div>
                            <div class="d-flex align-items-center mb-4pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">ac_unit</span>
                                <p class="flex text-50 lh-1 mb-0"><small>Status: {{ $course->status }}</small></p>
                            </div>
                            <div class="d-flex align-items-center mb-4pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">monetization_on</span>
                                <p class="flex text-50 lh-1 mb-0"><small>Terjual: {{ $course->sold }}</small></p>
                            </div>
                            <div class="d-flex align-items-center mb-4pt">
                                <span class="material-icons icon-16pt text-50 mr-4pt">money</span>
                                <p class="flex text-50 lh-1 mb-0"><small>Penghasilan: Rp{{ number_format($course->income) }}</small></p>
                            </div>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('team.courses.edit', $course->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>

                </div>

            </div>
            @endforeach
        </div>
        {{ $courses->links() }}
    </div>
    @endsection
