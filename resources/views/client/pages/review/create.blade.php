@extends('client.layouts.app')

@section('review', 'active', 'styles')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>

@section('content')
  <div name="review-create-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-12">
          <h3>Beri Ulasan</h3>
        </div>
      </div>
      @if (count($transaction->details->whereNull('review_id')))
          @foreach ($transaction->details as $detail)
            @if (!$detail->review_id)
              <div class="row my-3">
                <div class="col-12">
                  <h5>{{ $detail->event->title }}</h5>
                  <h6>{{ $detail->packet->name }}</h6>
                  <h6>{{ $detail->venue->name }}</h6>
                </div>
              </div>

              <form action="{{ route('client.review.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <label for="email" class="form-label">Ulasan</label>
                    <input class="form-control mb-2" type="text" name="review" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <label for="email" class="form-label">Nama</label>
                    <input class="form-control mb-2" type="text" name="name" required>
                  </div>
                </div>
        
                <input type="hidden" name="transaction_id" value="{{ $detail->id }}">
        
                <div class="row border-bottom pb-4">
                  <div class="col-12">
                    <button type="submit" class="filled-button mt-2">Kirim</button>
                  </div>
                </div>
              </form>
            @endif
          @endforeach
      @else
        <div class="row">
          <div class="col-12">
            <p class="text-center">Semua sudah diulas</p>

            <a href="{{ route('client.payment.index') }}" class="filled-button mt-2">Kembali ke halaman List Transaksi</a>
          </div>
        </div>
      @endif

    </div>
  </div>
@endsection