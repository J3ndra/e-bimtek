@extends('admin.layout.main')

@section('title', 'Data Channel Pembayaran')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
<x-breadcumb title="Data Channel Pembayaran" />
<div class="container page__container page-section">
	<div class="page-separator">
		<div class="page-separator__text">Data Channel Pembayaran</div>
		<form method="POST" action="{{ route('admin.channels.sync') }}" class="d-inline ml-auto">
			@csrf

			<button type="submit" class="btn btn-primary ml-auto"><i class="fa fa-circle-notch mr-2"></i> Sync</button>
		</form>
	</div>
	@if(session('message'))
	<x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
	@endif
	<div class="card mb-lg-32pt">
		<div class="table-responsive" data-toggle="lists" data-lists-sort-desc="true" data-lists-values='["js-lists-values-code", "js-lists-values-name", "js-lists-values-group", "js-lists-values-fee-flat", "js-lists-values-fee-percent", "js-lists-values-status"]'>
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
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-code">Code</a>
						</th>
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-name">Name</a>
						</th>
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-group">Group</a>
						</th>
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-fee-flat">Fee Flat</a>
						</th>
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-fee-percent">Fee Percent</a>
						</th>
						<th>
							<a href="javascript:void(0)" class="sort" data-sort="js-lists-values-status">Status</a>
						</th>
						<th></th>
					</tr>
				</thead>
				<tbody class="list" id="clients">
					@foreach($channels as $channel)
					<tr>
						<td> <small class="js-lists-values-number text-50">{{ $channel->code }}</small>
						</td>
						<td> <small class="js-lists-values-name text-50">{{ $channel->name }}</small>
						</td>
						<td> <small class="js-lists-values-group text-50">{{ $channel->group }}</small>
						</td>
						<td> <small class="js-lists-values-fee-flat text-50">Rp{{ number_format($channel->fee_flat) }}</small>
						</td>
						<td> <small class="js-lists-values-fee-percent text-50">{{ $channel->fee_percent }}%</small>
						</td>
						<td> <small class="js-lists-values-status text-50">{{ $channel->status }}</small>
						</td>
						<td class="text-right">
							<a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
								<i class="material-icons">more_vert</i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="{{ route('admin.channels.edit', $channel->id) }}" class="dropdown-item">Edit</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{ $channels->links() }}
	</div>
</div>
@endsection

@section('scripts')
<!-- List.js -->
<script src="{{ asset('vendor/list.min.js') }}"></script>
<script src="{{ asset('js/list.js') }}"></script>
@endsection