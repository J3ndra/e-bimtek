@extends('admin.layout.auth')
@section('title', 'Laporan')
@section('styles')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<!-- Flatpickr -->
<link type="text/css" href="{{ asset('css/flatpickr.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('css/flatpickr-airbnb.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Laporan" sub="Laporan Tanggal {{ $start }} s/d {{ $end }}" />
<div class="container page__container">
    <div class="page-section">
        <div class="row card-group-row mb-lg-8pt">
            <div class="col-lg-4 col-md-6 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex d-flex align-items-center">
                            <div class="h2 mb-0 mr-3">{{ $customer }}</div>
                            <div class="flex">
                                <div class="card-title">Pengguna Baru</div>
                            </div>
                        </div>
                        <i class="material-icons icon-32pt text-20 ml-8pt">perm_identity</i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex d-flex align-items-center">
                            <div class="h2 mb-0 mr-3">{{ $sold }}</div>
                            <div class="flex">
                                <div class="card-title">Penjualan</div>
                            </div>
                        </div>
                        <i class="material-icons icon-32pt text-20 ml-8pt">assessment</i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex d-flex align-items-center">
                            <div class="h2 mb-0 mr-3">Rp{{ $income }}</div>
                            <div class="flex">
                                <div class="card-title">Penghasilan</div>
                            </div>
                        </div>
                        <i class="material-icons icon-32pt text-20 ml-8pt">shopping_basket</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-lg-32pt">
            <div class="card-header p-0 nav">
                <div class="row no-gutters flex" role="tablist">
                    <div class="col-auto">
                        <div class="p-card-header">
                            <div class="card-title">Chart Penjualan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $chart->render() !!}
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')

<!-- Moment.js -->
<script src="{{ asset('vendor/moment.min.js') }}"></script>
<script src="{{ asset('vendor/moment-range.js') }}"></script>

<!-- Flatpickr -->
<script src="{{ asset('vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/flatpickr.js') }}"></script>

<!-- Chart.js -->
<script src="{{ asset('vendor/Chart.min.js') }}"></script>
<script src="{{ asset('js/chartjs.js') }}"></script>
<script src="{{ asset('js/chartjs-rounded-bar.js') }}"></script>
@endsection
