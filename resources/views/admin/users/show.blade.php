@extends('admin.layout.main')

@section('title', 'Data User')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
<x-breadcumb title="Data User" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Data User {{ $user->name }}</div>
    </div>
	@if(session('message'))
	<x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
	@endif

    <div class="row card-group-row mb-lg-8pt">
        <div class="col-lg-7 card-group-row__col">

            <div class="card card-group-row__card d-flex flex-column">
                <div class="row no-gutters flex">
                    <div class="col-6">
                        <div class="card-body">
                            <h6 class="text-50">Total Bimtek</h6>

                            <div class="h2 mb-0">{{ count($user->paided) }}</div>
                            <div class="d-flex flex-column">
                                <strong>{{ count($user->paided) }} X mengikuti</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="h2 mb-0">{{ round($user->score('average')) }}</div>
                            <div class="d-flex flex-column">
                                <strong>Nilai rata rata</strong>
                                <small class="text-50">Dalam {{ count($user->score()) }}x melakukan tes</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 border-left">
                        <div class="card-body">
                            <h6 class="text-50">Total Sertifikat</h6>

                            <div class="h2 mb-0">{{ count($user->certificates) }} <small>x</small></div>
                            <div class="d-flex flex-column">
                                <strong>Sertifikat terbit</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="h2 mb-0">{{ number_format($user->payment->sum('amount')) }}</div>
                            <div class="d-flex flex-column">
                            <strong>Pengeluaran</strong>
                            <small class="text-50">Total uang yang dikeluarkan user</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-5 card-group-row__col">

            <div class="card card-group-row__card">
                <div class="card-body">
                    <h6>Kursus Terakhir</h6>

                    @foreach($user->paided()->paginate(3) as $paid)
                    @if($loop->iteration == 1)
                    <div class="d-flex align-items-center">
                        <div class="mr-12pt">
                            <div class="avatar avatar-xl avatar-4by3">
                                <img src="{{ Storage::url($paid->course->thumbnail) }}"
                                     alt="{{ $paid->course->title }}"
                                     class="avatar-img rounded">
                            </div>
                        </div>
                        <div class="flex">
                            <a href=""
                               class="card-title">{{ $paid->course->title }}</a>
                            <small class="text-50">Terdaftar pada {{ $paid->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    @else
                    <div class="d-flex align-items-center mb-8pt">
                        <div class="mr-8pt">
                            <div class="avatar avatar-sm avatar-4by3">
                                <img src="{{ Storage::url($paid->course->thumbnail) }}"
                                     alt="{{ $paid->course->title }}"
                                     class="avatar-img rounded">
                            </div>
                        </div>
                        <div class="flex d-flex flex-column">
                            <a href=""
                               class="card-title">{{ $paid->course->title }}</a>
                            <small class="text-50">Terdaftar pada {{ $paid->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>

        </div>
    </div>

    <div class="page-separator">
        <div class="page-separator__text">Daftar Bimtek</div>
    </div>

    <div class="posts-cards mb-24pt">

        @foreach($user->paided()->paginate(4) as $paid)
        <div class="card posts-card">
            <div class="posts-card__content d-flex align-items-center flex-wrap">
                <div class="avatar avatar-lg mr-3">
                    <a href=""><img src="{{ Storage::url($paid->course->thumbnail) }}"
                             alt="{{ $paid->course->title }}"
                             class="avatar-img rounded"></a>
                </div>
                <div class="posts-card__title flex d-flex flex-column">
                    <a href=""
                       class="card-title mr-3">{{ $paid->course->title }}</a>
                    <small class="text-50">Terdaftar pada {{ $paid->created_at->format('d M Y') }}</small>
                </div>
                <div class="d-flex align-items-center flex-column flex-sm-row posts-card__meta">
                    <div class="mr-3 text-50 text-uppercase posts-card__tag d-flex align-items-center">
                        Nilai post test {{ !empty($paid->course->post_test) ? $paid->course->post_test->scores()->max('score') : 0 }}
                    </div>
                    <div class="mr-3 text-50 ">
                        <small>Sebesar Rp.{{ number_format($paid->amount_received) }} dengan {{ $paid->channel->name }}</small>
                    </div>
                </div>
                <div class="dropdown ml-auto">
                    <a href="#"
                       data-toggle="dropdown"
                       data-caret="false"
                       class="text-muted"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)"
                           class="dropdown-item score-list" data-id="{{ $paid->course->id }}">Daftar Nilai</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="page-separator scoreSegment" hidden>
        <div class="page-separator__text">Daftar Nilai</div>
    </div>
    <div class="card table-responsive scoreSegment" hidden>
        <table class="table mb-0 thead-border-top-0 table-nowrap">
            <thead>
                <tr>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-number">#</a>
                    </th>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Judul</a>
                    </th>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Kursus</a>
                    </th>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Tipe</a>
                    </th>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">Nilai</a>
                    </th>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">Status</a>
                    </th>
                    <th> <a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">Detail</a>
                    </th>
                </tr>
            </thead>
            <tbody class="list" id="scoreTable">
            </tbody>
        </table>
    </div>
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
                            <td>
                                <a href="{{ route('admin.users.score.detail') }}/${val.id}" class="btn btn-sm btn-primary"/>
                                    Detail
                                </a>
                            </td>
                        </tr>
                        `);
                    });
                }
            });
        })
    })
</script>
@endsection
