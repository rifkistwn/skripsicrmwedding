@extends('client.layouts.app')

@section('packet', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/packet/packet-index.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/client/promo/promo-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="packet-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h2>Paket</h2>
            </div>
        </div>

        {{-- start::packets card --}}
        @if (count($packets))
          @foreach ($packets as $packet)
            <div class="col-md-4">
              <a href="{{ route('client.packet.show', $packet->code) }}">
                <div class="product-item card-hover-shadow" name="packet-card">
                    <div class="packet-thumbnail cover-image" style="background-image: {{ "url('" . asset("storage/{$packet->image}") . "')" }}"></div>
                    <div class="down-content text-center">
                      <h4 class="mb-0">{{ $packet->name }}</h4>
                      
                      @if ($packet->active_promo)
                        <div class="promo-prices">
                          <div class="discount my-2 d-flex gap-2 justify-content-center">
                            <div class="badge badge-danger d-flex align-items-center">{{ $packet->active_promo->discount }}%</div>
                            <p class="mb-0 price-discount">Rp. {{ number_format($packet->price) }},-</p>
                          </div>
                          <p class="mb-0 font-weight-bold">Rp. {{ number_format($packet->discounted_price) }},-</p>
                        </div>
                      @else
                        <p class="mb-0 font-weight-bold">Rp. {{ number_format($packet->price) }},-</p>
                      @endif

                      <button class="filled-button mt-2">Lihat Selengkapnya</button>
                    </div>
                </div>
              </a>
            </div>
          @endforeach
        @else
          <p class="text-muted text-center">Belum ada paket.</p>
        @endif
        {{-- end::packets card --}}
      </div>
    </div>
  </div>
@endsection