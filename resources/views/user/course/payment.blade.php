@extends('user.layout.main')
@section('title', 'Pembayaran: ' . $payment->code)
@section('content')
<div class="mdk-header-layout__content page-content ">
    <div class="page-section bg-primary border-bottom-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-6 mb-24pt mb-lg-0">
                            <p class="text-white-70 mb-0"><strong>Pemesanan oleh</strong></p>
                            <h2 class="text-white">{{ $payment->user->name }}</h2>
                        </div>
                        <div class="col-md-6">
                            <p class="text-white-70 mb-0"><strong>Disiapkan oleh</strong></p>
                            <h2 class="text-white">{{ config('app.name') }}</h2>
                        </div>
                    </div>
                </div>
                <div
                class="col-lg-3 text-lg-right d-flex flex-lg-column mb-24pt mb-lg-0 border-bottom border-lg-0 pb-16pt pb-lg-0">
                <div class="flex">
                    <p class="text-white-70 mb-8pt"><strong>Invoice</strong></p>
                    <p class="text-white-50">
                        {{ $payment->created_at->format('d F Y H:i') }}<br>
                        {{ $payment->code }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container page__container  mt-2">
    <div class="page-separator">
        <div class="page-separator__text">Pembayaran</div>
    </div>
    <div class="card table-responsive mb-24pt">
        <table class="table table-flush table--elevated">
            <thead>
                <tr>
                    <th>Metode Pembayaran</th>
                    <th>Deskripsi</th>
                    <th style="width: 60px;" class="text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $payment->channel->name }}</td>
                    <td>
                        <p class="mb-0"><strong>{{ $payment->course->title }}</strong></p>
                        <p class="text-50">Masa pembayaran akan berakhir pada {{ $payment->created_at->addDays(1)->format('d F Y H:i') }}</p>
                    </td>
                    <td class="text-right"><strong>Rp{{ number_format($payment->amount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-flush">
            <tfoot>
                <tr>
                    <td>
                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#howTo">Petunjuk Pembayaran</button>
                    </td>
                    <td class="text-right text-70"><strong>Total</strong></td>
                    <td style="width: 60px;" class="text-right"><strong>Rp{{ number_format($payment->amount, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>
@endsection
@section('modals')
<div class="modal fade" id="howTo" tabindex="-1" role="dialog" aria-labelledby="howToTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        @if(is_null($tripay))
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">INSTRUKSI TRANSFER MANUAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! setting('mt_instruction') !!}
      </div>
        @else
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ $tripay['instructions'][0]['title'] }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(isset($tripay['qr_url']))
        <center><img src="{{ $tripay['qr_url'] }}" width="180px" class="align-items-center"></center>
        @endif
        <ul>
            @foreach($tripay['instructions'][0]['steps'] as $step)
            <li>{!! $step !!}</li>
            @endforeach
        </ul>
      </div>
      @endif
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
