@extends('user.layout.main')
@section('title', 'Home')
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div id="carouselExampleControls" class="carousel slide mb-3" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $slider)
            <div class="carousel-item {{ ($loop->iteration == 1) ? 'active' : '' }}">
                <img src="{{ Storage::url($slider->picture) }}" class="d-block w-100" alt="{{ $slider->name }}">
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    @if($latestCourse)
    <div class="mdk-box mdk-box--bg-primary js-mdk-box mb-0" hidden="hidden"
                data-effects="parallax-background blend-background">
                <div class="mdk-box__bg">
                    <div class="mdk-box__bg-front"
                        style="background-image: url({{ asset('images/photodune-4161018-group-of-students-m.jpg') }});">
                    </div>
                </div>
                <div class="mdk-box__content justify-content-center">
                    <div class="hero container page__container text-center py-112pt">
                        <h1 class="text-white text-shadow">{{ $latestCourse->title }}</h1>
                        <a href=""></a>
                        <p class="lead measure-hero-lead mx-auto text-white text-shadow mb-48pt">
                            {!! Str::limit(strip_tags($latestCourse->description), 55, ' <a href="">[Read More]</a>') !!} <br>
                            Tanggal Mulai: {{ $latestCourse->start_date->format('d F Y') }}
                        </p>

                        <a href="{{ route('course', $latestCourse->slug) }}" class="btn btn-lg btn-white btn--raised mb-16pt">Selengkapnya</a>

                        <p class="mb-0"><a href="{{ route('register') }}" class="text-white text-shadow"><strong>Belum mendaftar? Daftar Sekarang.</strong></a></p>

                    </div>
                </div>
            </div>
    @endif
    <div class="page-section border-bottom-2 bg-white">
        <div class="container page__container">
            <div class="page-headline text-center">
                <h2>Keunggulan</h2>
                <p class="lead measure-lead mx-auto text-70">{{ config('app.name') }} merupakan platform terbaik untuk
                    memulai pengalaman belajarmu.</p>
            </div>
            <div class="row align-items-center">
                <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt pb-16pt pb-md-0">
                    <div
                        class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                        <i class="material-icons text-white">subscriptions</i>
                    </div>
                    <div class="flex">
                        <div class="card-title mb-4pt">Materi Terbaik</div>
                        <p class="card-subtitle text-70">Materi dalam setiap Bimtek sudah melalui tahapan lolos uji
                            sesuai dengan kurikulum yang dirumuskan.</p>
                    </div>
                </div>
                <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt pb-16pt pb-md-0">
                    <div
                        class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                        <i class="material-icons text-white">verified_user</i>
                    </div>
                    <div class="flex">
                        <div class="card-title mb-4pt">Instruktur Berpengalaman</div>
                        <p class="card-subtitle text-70">Para pengajar di {{ config('app.name') }} merupakan praktisi yang
                            bersertifikat pada bidang yang diajarkannya.</p>
                    </div>
                </div>
                <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt pb-16pt pb-md-0">
                    <div
                        class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                        <i class="material-icons text-white">update</i>
                    </div>
                    <div class="flex">
                        <div class="card-title mb-4pt">Sertifikat Portofolio</div>
                        <p class="card-subtitle text-70">Sertifikat yang didapatkan bukanlah sertifikat kelulusan, namun
                            sertifikat berdasarkan proyek yang sudah kamu lakukan.</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                    <div
                        class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                        <i class="material-icons text-white">code</i>
                    </div>
                    <div class="flex">
                        <div class="card-title mb-4pt">Materi Berdasarkan Kasus</div>
                        <p class="card-subtitle text-70">Karena Bimtek ini memiliki waktu yang singkat, maka Kami
                            membuat materi berdasarkan kasus nyata, tidak hanya teori.</p>
                    </div>
                </div>
                <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                    <div
                        class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                        <i class="material-icons text-white">layers</i>
                    </div>
                    <div class="flex">
                        <div class="card-title mb-4pt">Tanya Jawab Langsung</div>
                        <p class="card-subtitle text-70">Kamu dapat bertanya secara langsung pada Instruktur saat kamu
                            tidak memahami suatu materi pada Bimtek.</p>
                    </div>
                </div>
                <div class="d-flex col-md align-items-center">
                    <div
                        class="rounded-circle bg-dark w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                        <i class="material-icons text-white">accessibility</i>
                    </div>
                    <div class="flex">
                        <div class="card-title mb-4pt">Harga Sangat Terjangkau</div>
                        <p class="card-subtitle text-70">Silakan bandingkan harga yang kami tawarkan dengan tempat
                            Bimtek lainnya. Murah tidak ada kaitannya dengan kualitas yang baik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Bimtek Terbaru</div>
            </div>
            <div class="row card-group-row">
                @forelse($courses as $course)
                <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                        data-toggle="popover" data-trigger="click">
                        <a href="{{ route('course', $course->slug) }}" class="card-img-top js-image" data-position=""
                            data-height="140">
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
                                        <span
                                            class="material-icons">{{ $course->stars <= $i ? 'star_border' : 'star' }}</span>
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
                                        <small>{{ $course->duration ?? '-' }}</small>
                                    </p>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
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
                                        <small>{{ $course->duration }}</small>
                                    </p>
                                </div>
                                <div class="d-flex align-items-center mb-4pt">
                                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                    <p class="flex text-50 lh-1 mb-0">
                                        <small>{{ $course->lessons()->count() }} pembelajaran</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('course', $course->slug) }}" class="btn btn-primary">Selengkapnya</a>
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
        </div>
    </div>
    <div class="page-section border-bottom-2">
        <div class="container page__container">
            <div class="page-separator">
                <div class="page-separator__text">Kategori</div>
            </div>
            <div class="row card-group-row">
                @forelse($categories as $category)
                <div class="col-sm-4 card-group-row__col">
                    <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                        data-toggle="popover" data-trigger="click">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <div class="flex">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded mr-12pt z-0 o-hidden">
                                            <div class="overlay">
                                                <img src="{{ Storage::url($category->icon) }}" width="40" height="40"
                                                    alt="Angular" class="rounded">
                                                <span class="overlay__content overlay__content-transparent">
                                                    <span class="overlay__action d-flex flex-column text-center lh-1">
                                                        <small class="h6 small text-white mb-0"
                                                            style="font-weight: 500;"></small>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <div class="card-title">{{ $category->name }}</div>
                                            <p class="flex text-50 lh-1 mb-0">
                                                <small>{{ $category->courses()->count() }} Bimtek</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="popoverContainer d-none">
                        <div class="media">
                            <div class="media-left mr-12pt">
                                <img src="{{ Storage::url($category->icon) }}" width="40" height="40" alt="Angular"
                                    class="rounded">
                            </div>
                            <div class="media-body">
                                <div class="card-title">{{ $category->name }}</div>
                                <p class="text-50 d-flex lh-1 mb-0 small">{{ $category->courses()->count() }}
                                    Bimtek</p>
                            </div>
                        </div>
                        <div class="my-32pt">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('category', $category->name) }}" class="btn btn-primary mr-8pt">Lihat
                                    semua Bimtek</a>
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
                                    <strong>Belum ada kategori saat ini.</strong><br>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @include('user.layout.partials.feedback')
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/splide-skyblue.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/splide-core.min.css') }}">

<style>
    .my-slider-progress {
      background: #ccc;
    }

    .my-slider-progress-bar {
      background: greenyellow;
      height: 2px;
      transition: width 400ms ease;
      width: 0;
    }
  </style>
@endsection
@section('scripts')
<script src="{{ asset('js/splide.min.js') }}"></script>
<script>
    var splide = new Splide( '.splide' );
    var bar    = splide.root.querySelector( '.my-slider-progress-bar' );

    // Update the bar width:
    splide.on( 'mounted move', function () {
      var end = splide.Components.Controller.getEnd() + 1;
      bar.style.width = String( 100 * ( splide.index + 1 ) / end ) + '%';
    } );

    splide.mount();
  </script>
@endsection
