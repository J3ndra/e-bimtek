@extends('admin.layout.main')

@section('title', 'Kuis')

@section('content')
<x-breadcumb title="Kuis" />
<div class="container page__container page-section">

    <div class="page-separator">
        <div class="page-separator__text">Kuis</div>
        <a class="btn btn-primary float-right ml-auto" href="{{ route('admin.quizzes.create') }}"><i
                class="fa fa-plus mr-2"></i> Kuis Baru</a>
    </div>

    @if(session('message'))
    <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif

    <div class="row card-group-row">
        @foreach($quizzes as $quiz)
        <div class="card-group-row__col col-md-6">
            <div class="card card-group-row__card card-sm">
                <div class="card-body d-flex align-items-center">
                    <a href="{{ route('admin.quizzes.edit', $quiz->id) }}"
                        class="avatar overlay overlay--primary avatar-4by3 mr-12pt">
                        <img src="{{ Storage::url(optional($quiz->course)->thumbnail) }}" alt="{{ $quiz->title }}"
                            class="avatar-img rounded">
                        <span class="overlay__content"></span>
                    </a>
                    <div class="flex">
                        <a class="card-title" href="javascript:void(0);">{{ $quiz->title }}</a>
                        <div class="card-subtitle text-50">{{ $quiz->type }} -> <b>{{ $quiz->course->title }}</b></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center">
                        <div class="flex mr-2">
                            <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="btn btn-light btn-sm">
                                <i class="material-icons icon--left">playlist_add_check</i> Jumlah Soal
                                <span class="badge badge-dark badge-notifications ml-2">{{ $quiz->amount }}</span>
                            </a>
                        </div>

                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i
                                    class="material-icons">more_horiz</i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="dropdown-item">Edit</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('admin.quizzes.destroy', $quiz->id) }}"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="dropdown-item">Hapus</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{ $quizzes->links() }}
</div>
@endsection
