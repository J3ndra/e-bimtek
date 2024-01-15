@extends('user.layout.main')
@section('title', 'Dashboard')
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-8pt">Dashboard</h1>
                </div>
                <div class="ml-lg-16pt">
                    <a href="{{ route('account.index') }}" class="btn btn-light">My Profile</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">
                    @if(session('message'))
                        <x-alert status="{{ session('status') }}">
                            {{ session('message') }}</x-alert>
                    @endif

                    @if(!auth()->user()->hasVerifiedEmail())
                        @if(session('resent'))
                            <x-alert status="success">
                                Link verifikasi telah dikirim ke email kamu.
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </x-alert>
                        @endif
                        <x-alert status="danger">
                            Email kamu belum terverifikasi, mohon segera diverifikasikan.
                            <form class="d-inline" method="POST"
                                action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm ml-3">Kirim email
                                    verifikasi</button>.
                            </form>
                        </x-alert>
                    @endif
                    <div class="page-separator">
                        <div class="page-separator__text">Bimtek</div>
                    </div>

                    <div class="row card-group-row">
                        @forelse($courses as $course)
                            <div class="col-sm-6 col-xl-4 card-group-row__col">

                                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card undefined"
                                    data-toggle="popover" data-trigger="click">

                                    <a href="student-take-course.html" class="card-img-top js-image" data-position=""
                                        data-height="140">
                                        <img src="{{ Storage::url($course->thumbnail) }}" alt="course">
                                        <span class="overlay__content">
                                            <span class="overlay__action d-flex flex-column text-center">
                                                <i class="material-icons icon-32pt">play_circle_outline</i>
                                                <span class="card-title text-white">Resume</span>
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
                                                @for($i = 0; $i < 5; ++$i)
                                                    <span
                                                        class="material-icons">{{ $course->stars <= $i ? 'star_border' : 'star' }}</span>
                                                    </span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row justify-content-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0">
                                                    <small>{{ $course->duration ?? '-' }}</small>
                                                </p>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <span
                                                    class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0">
                                                    <small>{{ $course->lessons()->count() }} pembelajaran</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popoverContainer d-none">
                                    <div class="media">
                                        <div class="media-left mr-12pt">
                                            <img src="{{ Storage::url($course->thumbnail) }}" width="40"
                                                height="40" alt="{{ $course->title }}" class="rounded">
                                        </div>
                                        <div class="media-body">
                                            <div class="card-title mb-0">{{ $course->title }}</div>
                                        </div>
                                    </div>
                                    <p class="my-16pt text-70">
                                        {{ Str::limit(strip_tags($course->description), 62, ' [...]') }}
                                    </p>

                                    <div class="my-32pt">
                                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                                            <div class="d-flex align-items-center mr-8pt">
                                                <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                <p class="flex text-50 lh-1 mb-0">
                                                    <small>{{ $course->duration ?? '-' }}</small>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                <p class="flex text-50 lh-1 mb-0">
                                                    <small>{{ $course->lessons()->count() }} pembelajaran</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('course', $course->slug) }}"
                                                class="btn btn-primary mr-8pt">Pelajari</a>
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

                    <div class="page-separator">
                        <div class="page-separator__text">Kuis</div>
                    </div>

                    <div class="row card-group-row">
                        @forelse($scores as $score)
                        <div class="card-group-row__col col-md-6">

                            <div class="card card-group-row__card card-sm">
                                <div class="card-body d-flex align-items-center">
                                    <a href="{{ route('quiz.score', $score->quiz_id) }}"
                                        class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                                        <img src="{{ Storage::url($score->quiz->course->thumbnail) }}"
                                            alt="{{ $score->quiz->course->title }}" class="avatar-img rounded">
                                        <span class="overlay__content"></span>
                                    </a>
                                    <div class="flex mr-12pt">
                                        <a class="card-title" href="{{ route('quiz.score', $score->quiz_id) }}">{{ $score->quiz->course->title }}</a>
                                        <div class="card-subtitle text-50">{{ $score->quiz->type }} | {{ $score->created_at->format('d-m-Y H:i') }}</div>
                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="lead text-headings lh-1">{{ $score->score }}</span>
                                        <small class="text-50 text-uppercase text-headings">Skor</small>
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
                                                <strong>Belum ada kuis yang telah dikerjakan.</strong><br>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforelse

                    </div>

                </div>
                <div class="col-lg-4">
                    @if($finished->count() > 0)
                        <div class="page-separator">
                            <div class="page-separator__text">Bimtek Yang Telah Selesai</div>
                        </div>
                        <div id="carouselExampleFade" class="carousel carousel-card slide mb-24pt">
                            <div class="carousel-inner">

                                @foreach($finished as $finish)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <a class="card border-0 mb-0" href="">
                                            <img src="{{ Storage::url($finish->thumbnail) }}" alt="Flinto"
                                                class="card-img" width="100%">
                                            <div class="fullbleed bg-primary" style="opacity: .5;"></div>
                                            <span
                                                class="card-body d-flex flex-column align-items-center justify-content-center fullbleed">
                                                <span class="row flex-nowrap">
                                                    <span
                                                        class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                        <span
                                                            class="h5 text-white text-uppercase font-weight-normal m-0 d-block">Telah
                                                            Selesai</span>
                                                        <span class="text-white-60 d-block mb-24pt">Jun 5, 2018</span>
                                                    </span>
                                                    <span class="col d-flex flex-column">
                                                        <span class="text-right flex mb-16pt">
                                                            <img src="{{ Storage::url($finish->thumbnail) }}"
                                                                width="64" alt="Flinto" class="rounded">
                                                        </span>
                                                    </span>
                                                </span>
                                                <span class="row flex-nowrap">
                                                    <span
                                                        class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                                        <img src="{{ asset('images/illustration/achievement/128/white.png') }}"
                                                            width="64" alt="achievement">
                                                    </span>
                                                    <span class="col d-flex flex-column">
                                                        <span>
                                                            <span
                                                                class="card-title text-white mb-4pt d-block">{{ $finish->title }}</span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                data-slide="next">
                                <span class="carousel-control-icon material-icons"
                                    aria-hidden="true">keyboard_arrow_right</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @endif

                    @include('user.layout.partials.recommended')
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
