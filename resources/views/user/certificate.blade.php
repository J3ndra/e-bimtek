@extends('user.layout.main')
@section('title', 'Sertifikat')
@section('content')
<div class="mdk-header-layout__content page-content ">

    <div class="page-section bg-alt border-bottom-2">
        <div class="container page__container">

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div
                    class="flex d-flex flex-column align-items-center align-items-lg-start mb-16pt mb-lg-0 text-center text-lg-left">
                    <h1 class="h2 mb-8pt">Sertifikat Saya</h1>
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
                        <div class="page-separator__text">Sertifikat</div>
                    </div>

                    <div class="row card-group-row mb-4">

                            <div class="col-sm-12 col-xl-12 card-group-row__col">

                                <div class="table-responsive" data-toggle="lists" data-lists-sort-desc="true" data-lists-values='["js-lists-values-number", "js-lists-values-name", "js-lists-values-date"]'>
                                    <div class="card-header">
                                        <div class="search-form">
                                            <input type="text" class="form-control search" placeholder="Search ...">
                                            <button class="btn" type="button"><i class="material-icons">search</i>
                                            </button>
                                        </div>
                                    </div>
                                    <table class="table mb-0 thead-border-top-0 table-nowrap">
                                        <thead>
                                            <tr>
                                                <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-number">#</a>
                                                </th>
                                                <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Bimtek</a>
                                                </th>
                                                <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Mandat</a>
                                                </th>
                                                <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Download</a>
                                                </th>
                                                <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Terdaftar Pada</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="clients">
                                            @foreach($certificates as $certificate)
                                            <tr>
                                                <td> <small class="js-lists-values-number text-50">{{ ($certificates ->currentpage()-1) * $certificates ->perpage() + $loop->index + 1 }}</small>
                                                </td>
                                                <td>{{ $certificate->course->title }}</td>
                                                <td>{{ $certificate->credential }}</td>
                                                <td>
                                                    <form action="{{ route('certificate', $certificate->course->slug) }}" method="POST">
                                                        @csrf

                                                        <button type="submit" class="btn btn-outline-primary btn-sm">Download Sertifikat
                                                        <i class="material-icons icon--right">play_circle_outline</i></button>
                                                    </form>
                                                </td>
                                                <td> <small class="js-lists-values-date text-50">{{ $certificate->created_at->format('d F Y') }}</small>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $certificates->links() }}

                            </div>
                        @if(empty($certificates))
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
                        @endif

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
