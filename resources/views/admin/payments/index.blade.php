@extends('admin.layout.main')

@section('title', 'Daftar Pembayaran')

@section('content')
<x-breadcumb title="Daftar Pembayaran" />
<div class="container page__container page-section">
    <div class="page-separator">
        <div class="page-separator__text">Daftar Pembayaran</div>
    </div>
    @if(session('message'))
    <x-alert status="{{ session('status') }}">{{ session('message') }}</x-alert>
    @endif
    <div class="card mb-lg-32pt">
        <div class="table-responsive" data-toggle="lists" data-lists-sort-desc="true"
            data-lists-values='["js-lists-values-slug", "js-lists-values-title", "js-lists-values-date"]'>
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
                        <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-kode">Kode</a></th>
                        <th>User</th>
                        <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-kursus">Bimtek</a></th>
                        <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-pembayaran">Pembayaran</a></th>
                        <th><a href="javascript:void(0)" class="sort"
                                data-sort="js-lists-values-reference">Reference</a></th>
                        <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-jumlah">Jumlah</a></th>
                        <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-status">Status</a></th>
                        <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-date">at</a>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="list" id="clients">
                    @foreach($payments as $payment)
                    <tr>
                        <td> <small class="js-lists-values-kode text-50">{{ $payment->code }}</small>
                        </td>
                        <td>{{ $payment->user->name }}</td>
                        <td> <small class="js-lists-values-kursus text-50">{{ $payment->course->title }}</small>
                        </td>
                        <td> <small class="js-lists-values-pembayaran text-50">{{ $payment->channel->name }}</small>
                        </td>
                        <td> <small class="js-lists-values-reference text-50">{{ $payment->reference }}</small>
                        </td>
                        <td> <small
                                class="js-lists-values-jumlah text-50">Rp{{ number_format($payment->amount, 2) }}</small>
                        </td>
                        <td> <small class="js-lists-values-status text-50">{{ $payment->approval }}</small>
                        </td>
                        <td> <small
                                class="js-lists-values-date text-50">{{ optional($payment->approval_at)->format('d F Y H:i') }}</small>
                        </td>
                        </td>
                        <td class="text-right">
                            <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form method="POST" action="{{ route('admin.payments.approve', $payment->id) }}"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="dropdown-item">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.payments.reject', $payment->id) }}"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="dropdown-item">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $payments->links() }}
    </div>
</div>
@endsection

@section('scripts')
<!-- List.js -->
<script src="{{ asset('vendor/list.min.js') }}"></script>
<script src="{{ asset('js/list.js') }}"></script>
@endsection
