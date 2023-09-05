@extends('client.layouts.app')

@section('payment', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/payment/payment-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="payment-index-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-12 mb-5">
          <div class="section-heading mb-0">
            <h2>List Transaksi</h2>
          </div>
        </div>
      </div>

      {{-- start::transaction list --}}
      @if (count($transactions))
        <div class="row">
          @foreach ($transactions as $trx)
            <div class="col-12">
              <div class="card w-100">
                <div class="card-body row">
                  <div class="col-12 d-flex gap-2 align-items-center">
                    <h5 class="card-title mb-0 h5">TRX - {{ $trx->id }}</h5>

                    @if (!$trx->status)
                      <span class="badge badge-warning">Menunggu Pembayaran</span>
                    @elseif($trx->status == 1)
                      <span class="badge badge-success">Selesai</span>
                    @elseif($trx->status == 2)
                      <span class="badge badge-success">Rejected</span>
                    @endif
                  </div>
                  
                  {{-- start::details --}}
                  @foreach ($trx->details as $detail)
                    <div class="col-12 my-2">
                      <h6>Paket {{ $detail->packet->name }}</h6>
                    </div>

                    @if ($detail->promo_id)
                      <div class="col-2">
                        <h6>Promo</h6>
                      </div>
                      
                      <div class="col-10">
                        <h6 class="text-muted">{{ $detail->promo->code }}</h6>
                      </div>
                    @endif

                    <div class="col-2 mb-3">
                      <h6>Harga</h6>
                    </div>
                    <div class="col-10 mb-3">
                      <h6 class="text-muted">Rp. {{ number_format($detail->price) }},-</h6>
                    </div>
                  @endforeach

                  <div class="col-12 border-top pt-3 mt-3 d-flex gap-2 justify-content-between align-items-center">
                    <div class="total d-flex gap-2">
                      <h6>Total</h6>
                      <h6>Rp. {{ number_format($trx->details->sum('price')) }},-</h6>
                    </div>
                    
                    @if (!$trx->status)
                      <a href="{{ route('client.payment.show', $trx->id) }}" class="filled-button">Selesaikan Pembayaran</a>
                    @elseif($trx->status == 1 && count($trx->details->whereNull('review_id')))
                      <a href="{{ route('client.review.create', $trx->id) }}" class="filled-button">Beri Ulasan</a>
                    @else
                      <p class="ab-text-primary">Sudah Diulas</p>
                    @endif
                  </div>
                  {{-- end::details --}}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-muted text-center">Belum ada transaksi.</p>
      @endif
      {{-- end::transaction list --}}
    </div>
  </div>
@endsection