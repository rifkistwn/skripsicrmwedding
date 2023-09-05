@extends('client.layouts.app')

@section('venue', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/venue/venue-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="venue-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h2>Tempat Acara</h2>
            </div>
        </div>

        {{-- start::venues card --}}
        @if (count($venues))
          @foreach ($venues as $venue)
            <div class="col-md-4">
              <a href="{{ route('client.venue.show', $venue->slug) }}">
                <div class="product-item card-hover-shadow" name="venue-card">
                    <div class="venue-thumbnail cover-image" style="background-image: {{ "url('" . asset($venue->thumbnail) . "')" }}"></div>
                    <div class="down-content text-center">
                      <h4 class="mb-0">{{ $venue->name }}</h4>
                      <p class="position-static my-4">Kapasitas: {{ $venue->capacity }} orang</p>
                      <p class="filled-button mt-2">Lihat Detail</p>
                      {{-- <ul class="stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                      </ul> --}}
                    </div>
                </div>
              </a>
            </div>
          @endforeach
        @else
          <p class="text-muted text-center">Belum ada Tempat Acara.</p>
        @endif
        {{-- end::venues card --}}
      </div>
    </div>
  </div>
@endsection