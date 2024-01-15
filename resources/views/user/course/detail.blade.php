@extends('user.layout.main')
@section('title', $course->title)
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="d-flex flex-column flex-md-row align-items-center flex mb-16pt mb-lg-0 text-center text-md-left">
                    <div class="avatar avatar mb-16pt mb-md-0 mr-md-16pt">
                        <img src="{{ Storage::url($course->thumbnail) }}" class="avatar-img rounded" alt="lesson">
                    </div>
                    <div class="flex">
                        <h1 class="h2 m-0">{{ $course->title }}</h1>
                        <div class="rating mb-8pt d-inline-flex">
                            @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                <span class="material-icons">
                                    {{ $course->stars <= $i ? 'star_border' : 'star' }}
                                </span>
                                </span>
                                @endfor
                        </div>
                    </div>
                </div>
                <div class="ml-lg-16pt">
                    <a href="{{ route('category', $course->category->name) }}"
                        class="btn btn-light">{{ $course->category->name }}</a>
                </div>
            </div>

        </div>
    </div>

    <div class="page-section border-bottom-2">
        <div class="container page__container">

            <div class="row">
                <div class="col-lg-8">

                    <div class="js-player card bg-primary text-center embed-responsive embed-responsive-16by9 mb-24pt">
                        <div class="player embed-responsive-item">
                            <div class="player__content align-items-center justify-content-center">
                                <p class="lead text-white-70 measure-lead">
                                    {{ Str::limit(strip_tags($course->description), 62, ' [...]') }}
                                </p>

                                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
                                    <a href="#" class="btn btn-outline-white">Lihat preview <i
                                            class="material-icons icon--right">play_circle_outline</i></a>
                                </div>
                            </div>
                            <div class="player__embed">
                                <iframe class="embed-responsive-item" src="{{ $course->trailer }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="mb-24pt">
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                            <i class="material-icons icon--left">schedule</i>
                            {{ $course->duration }}
                        </span>
                        <span class="chip chip-outline-secondary d-inline-flex align-items-center">
                            <i class="material-icons icon--left">schedule</i>
                            {{ $course->start_date->format('d F Y') }}
                        </span>
                    </div>

                    @if(isSold($course->id))
                    <div class="border-left-2 page-section pl-32pt mb-32pt">
                        @forelse($course->lessons()->get() as $lesson)
                        <div class="d-flex align-items-center page-num-container">
                            <div class="page-num">{{ $loop->iteration }}</div>
                            <h4>{{ $lesson->title }}</h4>
                        </div>

                        <p class="text-70 measure-paragraph-max mb-24pt">{!! $lesson->description !!}</p>

                        <ul class="accordion accordion--boxed js-accordion measure-paragraph-max mb-32pt mb-lg-64pt"
                            id="toc-{{ $loop->iteration }}">
                            <li class="accordion__item open">
                                <a class="accordion__toggle" data-toggle="collapse"
                                    data-parent="#toc-{{ $loop->iteration }}"
                                    href="#toc-content-{{ $loop->iteration }}">
                                    <span class="flex">{{ $lesson->title }}
                                        {{ now()->format('Y-m-d') <= $lesson->date->format('Y-m-d') ? '(Dibuka pada tanggal ' . $lesson->date->format('d F Y') . ')' : '' }}</span>
                                    <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                </a>
                                <div class="accordion__menu">
                                    <ul class="list-unstyled collapse show" id="toc-content-{{ $loop->iteration }}">
                                        @foreach($lesson->subLessons()->get() as $sub)
                                        <li class="accordion__menu-link">
                                            <span
                                                class="material-icons icon-16pt icon--left text-body">drag_handle</span>
                                            <a class="flex"
                                                href="{{ now()->format('Y-m-d') >= $lesson->date->format('Y-m-d') ? route('sublesson', [$course->slug, $lesson->id, $sub->id]) : 'javascript:void(0);' }}">{{ $sub->title }}</a>
                                            <span class="text-muted">{{ $sub->duration }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        @empty
                        <div class="alert alert-soft-warning mb-24pt">
                            <div class="d-flex flex-wrap align-items-start">
                                <div class="mr-8pt">
                                    <i class="material-icons">access_time</i>
                                </div>
                                <div class="flex" style="min-width: 180px">
                                    <small class="text-black-100">
                                        <strong>Belum ada pembelajaran.</strong><br>
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    @if($course->end_date->format('Y-m-d') <= now()->format('Y-m-d'))
                        <div class="row mb-24pt">
                            <div class="col-md-12">
                                <div class="page-separator">
                                    <div class="page-separator__text">Selesai</div>
                                </div>
                                @if($postQuiz)
                                <p>Selesaikan kuis terakhir untuk mendapatkan sertifikat.</p>
                                <form action="{{ route('quiz.start', $postQuiz->id) }}" method="POST" class="d-inline">
                                    @csrf

                                    <button type="submit" class="btn btn-outline-primary mb-16pt mb-sm-0 mr-sm-16pt">Kerjakan Kuis
                                    <i class="material-icons icon--right">play_circle_outline</i></button>
                                </form>
                                @else
                                <form action="{{ route('certificate', $course->slug) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-outline-primary mb-16pt mb-sm-0 mr-sm-16pt">Download Sertifikat
                                    <i class="material-icons icon--right">play_circle_outline</i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endif

                        <div class="row mb-24pt">
                            <div class="col-md-12">
                                <div class="page-separator">
                                    <div class="page-separator__text">Deskripsi</div>
                                </div>
                                {!! $course->description !!}
                            </div>
                        </div>

                        <div class="page-separator">
                            <div class="page-separator__text">Ulasan</div>
                        </div>
                        <div class="row mb-32pt">
                            <div class="col-md-3 mb-32pt mb-md-0">
                                <div class="display-1">{{ $course->stars }}</div>
                                <div class="rating rating-24">
                                    @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                        <span class="material-icons">
                                            {{ $course->stars <= $i ? 'star_border' : 'star' }}
                                        </span>
                                        </span>
                                        @endfor
                                </div>
                                <p class="text-muted mb-0">{{ $course->feedbacks()->count() }} ratings</p>
                            </div>
                            <div class="col-md-9">

                                <div class="row align-items-center mb-8pt" data-toggle="tooltip"
                                    data-title="{{ $course->percentageStar(5) }}% rated 5/5" data-placement="top">
                                    <div class="col-md col-sm-6">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-secondary" role="progressbar"
                                                aria-valuenow="{{ $course->percentageStar(5) }}"
                                                style="width: {{ $course->percentageStar(5) }}%" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                        <div class="rating">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-8pt" data-toggle="tooltip"
                                    data-title="{{ $course->percentageStar(4) }}% rated 4/5" data-placement="top">
                                    <div class="col-md col-sm-6">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-secondary" role="progressbar"
                                                aria-valuenow="{{ $course->percentageStar(4) }}"
                                                style="width: {{ $course->percentageStar(4) }}%" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                        <div class="rating">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-8pt" data-toggle="tooltip"
                                    data-title="{{ $course->percentageStar(3) }}% rated 3/5" data-placement="top">
                                    <div class="col-md col-sm-6">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-secondary" role="progressbar"
                                                aria-valuenow="{{ $course->percentageStar(3) }}"
                                                style="width: {{ $course->percentageStar(3) }}%" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                        <div class="rating">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-8pt" data-toggle="tooltip"
                                    data-title="{{ $course->percentageStar(2) }}% rated 2/5" data-placement="top">
                                    <div class="col-md col-sm-6">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-secondary" role="progressbar"
                                                aria-valuenow="{{ $course->percentageStar(2) }}"
                                                style="width: {{ $course->percentageStar(2) }}%" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                        <div class="rating">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-8pt" data-toggle="tooltip"
                                    data-title="{{ $course->percentageStar(1) }}% rated 0/5" data-placement="top">
                                    <div class="col-md col-sm-6">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-secondary" role="progressbar"
                                                aria-valuenow="{{ $course->percentageStar(1) }}"
                                                aria-valuemin="{{ $course->percentageStar(1) }}" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
                                        <div class="rating">
                                            <span class="rating__item"><span class="material-icons">star</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                            <span class="rating__item"><span
                                                    class="material-icons">star_border</span></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @foreach($course->feedbacks()->latest()->limit(3)->get() as $feed)
                        <div class="pb-16pt mb-16pt border-bottom row">
                            <div class="col-md-3 mb-16pt mb-md-0">
                                <div class="d-flex">
                                    <a href="javascript:void(0);" class="avatar avatar-sm mr-12pt">
                                        <!-- <img src="{{ $feed->user->initial }}" alt="avatar" class="avatar-img rounded-circle"> -->
                                        <span class="avatar-title rounded-circle">{{ $feed->user->initial }}</span>
                                    </a>
                                    <div class="flex">
                                        <p class="small text-muted m-0">{{ $feed->created_at->diffForHumans() }}
                                        </p>
                                        <a href="javascript:void(0);" class="card-title">{{ $feed->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="rating mb-8pt">
                                    @for($i = 0; $i < 5; ++$i) <span class="rating__item">
                                        <span class="material-icons">
                                            {{ $feed->stars <= $i ? 'star_border' : 'star' }}
                                        </span>
                                        </span>
                                        @endfor
                                </div>
                                <p class="text-70 mb-0">{{ $feed->feedback }}</p>
                            </div>
                        </div>
                        @endforeach

                        @if(auth('web')->check() && isSold($course->id))
                        <form action="{{ route('feedback', $course->id) }}" method="POST">
                        @csrf

                        <div class="list-group">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-question" class="m-0 form-group">
                                    <div class="form-row">
                                        <label id="label-question" for="question"
                                            class="col-md-3 col-form-label form-label">Feedback</label>
                                        <div class="col-md-9">
                                            <textarea id="question" placeholder="Tulisan kesan pesan" rows="4"
                                                class="form-control" name="feedback">{{ $feedback ? $feedback->feedback : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="form-group m-0" role="group" aria-labelledby="label-topic">
                                    <div class="form-row align-items-center">
                                        <label id="label-topic" for="topic"
                                            class="col-md-3 col-form-label form-label">Rating</label>
                                        <div class="col-md-9">
                                            <select id="topic" name="stars" class="form-control custom-select w-auto">
                                                <option value="5" {{ !$feedback ? '' : ($feedback->stars == 5 ? 'selected' : '') }}>5</option>
                                                <option value="4" {{ !$feedback ? '' : ($feedback->stars == 4 ? 'selected' : '') }}>4</option>
                                                <option value="3" {{ !$feedback ? '' : ($feedback->stars == 3 ? 'selected' : '') }}>3</option>
                                                <option value="2" {{ !$feedback ? '' : ($feedback->stars == 2 ? 'selected' : '') }}>2</option>
                                                <option value="1" {{ !$feedback ? '' : ($feedback->stars == 1 ? 'selected' : '') }}> 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <button type="submit" class="btn btn-accent">{{ $feedback ? 'Edit' : 'Kirim' }}</button>
                            </div>
                        </div>
                        </form>
                        @endif

                </div>

                <div class="col-lg-4">
                    @if(auth('web')->check())
                    @if(!isSold($course->id))
                    <div class="card">
                        <div class="card-body py-16pt text-center">
                            <span
                                class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                <i class="material-icons">timer</i>
                            </span>
                            <h4 class="card-title"><strong>Beli Sekarang!</strong></h4>
                            <p class="card-subtitle text-70 mb-24pt">Dapatkan akses Bimtek terbaik segera
                                disini!
                            </p>
                            @if($preQuiz)
                            <p class="card-subtitle text-70 mb-24pt">Sebelum membeli Bimtek, selesaikan
                                terlebih dahulu kuisnya.
                            </p>
                            <form action="{{ route('quiz.start', $preQuiz->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-accent mb-8pt">Start Kuis</button>
                            </form>
                            @else
                            <button type="button" class="btn btn-accent mb-8pt" data-toggle="modal"
                                data-target=".bd-payment-modal-lg">Beli
                                Rp{{ number_format($course->price) }}</button>
                            @endif
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="card">
                        <div class="card-body py-16pt text-center">
                            <span
                                class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                                <i class="material-icons">timer</i>
                            </span>
                            <h4 class="card-title"><strong>Unlock Course</strong></h4>
                            <p class="card-subtitle text-70 mb-24pt">Dapatkan akses Bimtek terbaik segera disini!
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-accent mb-8pt">Daftar
                                Sekarang</a>
                            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                            </p>
                        </div>
                    </div>

                    @endif

                    @include('user.layout.partials.recommended')
                </div>
            </div>

        </div>
    </div>

    @include('user.layout.partials.feedback')
</div>
@endsection
@section('modals')
@if(!$preQuiz)
<div class="modal fade bd-payment-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myPaymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Metode Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    @foreach($channels as $channel)
                    <form method="POST" action="{{ route('course.pay', [$course->id, $channel->code]) }}"
                        class="d-inline form-delete">
                        @csrf

                        <button type="submit" class="btn btn-primary m-1">{{ $channel->code }}</button>
                    </form>
                    @endforeach
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
