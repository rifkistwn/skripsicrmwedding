@extends('client.layouts.app')

@section('promo', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/promo/promo-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="promo-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h2>Promo</h2>
            </div>
        </div>

        {{-- start::promos card --}}
        @if (count($promos))
          @foreach ($promos as $promo)
            <div class="col-md-4">
              <a href="{{ route('client.promo.show', $promo->code) }}">
                <div class="product-item card-hover-shadow" name="promo-card">
                  <div class="promo-thumbnail cover-image" style="background-image: {{ "url('" . asset('storage/'.$promo->packet->image) . "')" }}"></div>
                    <div class="down-content text-center">
                      {{-- <h4 class="my-2">{{ $promo->code }}</h4> --}}
                      <p class="mb-0 font-weight-bold">{{ $promo->packet->name }}</p>
                      <p class="my-2">{{ $promo->venue->name ?? 'Not Included Venue' }}</p>

                      <div class="promo-prices">
                        <div class="discount my-2 d-flex gap-2 justify-content-center">
                          <div class="badge badge-danger d-flex align-items-center">{{ $promo->discount }}%</div>
                          <p class="mb-0 price-discount">Rp. {{ number_format($promo->packet->price) }},-</p>
                        </div>
                        <p class="mb-0 font-weight-bold">Rp. {{ number_format($promo->discounted_price) }},-</p>
                      </div>
                      <button class="filled-button mt-2">Lihat Selengkapnya</button>
                    </div>
                </div>
              </a>
            </div>
          @endforeach
        @else
          <p class="text-muted text-center">Belum ada promo.</p>
        @endif
        {{-- end::promos card --}}
      </div>
    </div>
  </div>
@endsection