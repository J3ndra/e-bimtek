@extends('team.layout.main')
@section('title', 'Dashboard')
@section('styles')
<!-- Flatpickr -->
<link type="text/css" href="{{ asset('css/flatpickr.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('css/flatpickr-airbnb.css') }}" rel="stylesheet">
@endsection
@section('content')
<x-breadcumb title="Dashboard" />
<div class="container page__container">
    <div class="page-section">

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
