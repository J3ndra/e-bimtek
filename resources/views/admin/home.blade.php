@extends('admin.layout.main')
@section('title', 'Home')
@section('content')
<x-breadcumb title="Dashboard" />
<div class=" page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Overview</div>
	</div>

	<div class="row card-group-row mb-lg-8pt">
		<div class="col-lg-7 card-group-row__col">

			<div class="card card-group-row__card d-flex flex-column">
				<div class="row no-gutters flex">
					<div class="col-6">
						<div class="card-body">
							<div class="h2 mb-0">{{ $users }}</div>
							<div class="d-flex flex-column">
								<strong>Pengguna Aktif</strong>
							</div>
						</div>
						<div class="card-body">
							<div class="h2 mb-0">{{ $courses }}</div>
							<div class="d-flex flex-column">
								<strong>Bimtek</strong>
							</div>
						</div>
					</div>
					<div class="col-6 border-left">
						<div class="card-body">
							<div class="h2 mb-0">Rp{{ earnings() }}</div>
							<div class="d-flex flex-column">
								<strong>Pendapatan</strong>
							</div>
						</div>
						<div class="card-body">
							<div class="h2 mb-0">{{ sales() }} Bimtek</div>
							<strong>Penjualan</strong>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-5 card-group-row__col">

			<div class="card card-group-row__card">
				<div class="card-body">
					<h6>Pembayaran Terakhir</h6>
				</div>
				<div class="card-body">
					@foreach($latestPayments as $payment)
					<div class="d-flex align-items-center mb-8pt">
						<div class="mr-8pt">
							<div class="avatar avatar-sm avatar-4 by3">
								@if($payment->user->avatar)
								<img src="{{ Storage::url($payment->user->avatar) }}" alt="{{ $payment->user->name }}" class="avatar-img rounded-circle">
								@else
								<span class="avatar-title rounded-circle">{{ $payment->user->initial }}</span>
								@endif
							</div>
						</div>
						<div class="flex d-flex flex-column">
							<a href=""
							class="card-title">{{ optional(optional($payment)->course)->title ?? 'Bimtek Telah Dihapus' }} - oleh {{ $payment->user->name }}</a>
							<small class="text-50">Rp{{ number_format($payment->amount, 2) }}</small>
						</div>
					</div>
					@endforeach
				</div>
			</div>

		</div>
	</div>

</div>
@endsection
