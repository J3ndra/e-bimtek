@extends('user.layout.main')
@section('title', 'Daftar Bimtek')
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="d-flex flex-column align-items-center align-items-lg-start flex mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-4pt">Bimtek</h1>
                    <div class="lead measure-lead text-70">Temukan semua Bimtek disini.</div>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">

                    <div class="page-separator">
                        <div class="page-separator__text">Bimtek Terbaru</div>
                    </div>

                    <div class="row card-group-row">
                        @forelse($courses as $course)
                        <div class="col-lg-6 col-xl-4 card-group-row__col">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                data-toggle="popover" data-trigger="click">

                                <a href="{{ route('course', $course->slug) }}" class="card-img-top js-image"
                                    data-position="" data-height="140">
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="course">
                                    <span class="overlay__content">
                                        <span class="overlay__action d-flex flex-column text-center">
                                            <i class="material-icons icon-32pt">play_circle_outline</i>
                                            <span class="card-title text-white">Preview</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="card-body flex">
                                    <div class="d-flex">
                                        <div class="flex">
                                            <a class="card-title"
                                                href="{{ route('course', $course->slug) }}">{{ $course->title }}</a>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="rating flex">
                                            @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                <span class="material-icons">
                                    {{ $course->stars <= $i ? 'star_border' : 'star' }}
                                </span>
                                </span>
                                @endfor
                                        </div>
                                        <!-- <small class="text-50">6 hours</small> -->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-between">
                                        <div class="col-auto d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                            <p class="flex text-50 lh-1 mb-0">
                                                <small>{{ $course->duration ?? '-' }}</small></p>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <span
                                                class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>{{ $course->lessons()->count() }}
                                                    pembelajaran</small></p>
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
                                            <p class="flex text-50 lh-1 mb-0">
                                                <small>{{ $course->duration ?? '-' }}</small></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4pt">
                                            <span
                                                class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-50 lh-1 mb-0"><small>{{ $course->lessons()->count() }}
                                                    pembelajaran</small></p>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <a href="{{ route('course', $course->slug) }}"
                                            class="btn btn-primary">Selengkapnya</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        @empty
                        <div class="col-lg-12">
                            <div class="alert alert-soft-warning mb-24pt">
                                <div class="d-flex flex-wrap align-items-start">
                                    <div class="mr-8pt">
                                        <i class="material-icons">access_time</i>
                                    </div>
                                    <div class="flex" style="min-width: 180px">
                                        <small class="text-black-100">
                                            <strong>Belum ada Bimtek saat ini.</strong><br>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <div class="mb-32pt">

                        {{ $courses->links() }}

                    </div>
                </div>
                @include('user.layout.partials.rightbar')
            </div>

        </div>
    </div>

    @include('user.layout.partials.feedback')

</div>
@endsection
