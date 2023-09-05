@extends('client.layouts.app')

@section('gallery', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/venue/venue-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="gallery-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        @if (count($events))
          @foreach ($events as $event)
          <div class="col-md-4">
              <a href="{{ route('client.gallery.show', $event->slug) }}">
                  <div class="product-item card-hover-shadow" name="venue-card">
                      @if ($event->gallery)
                          <div class="venue-thumbnail cover-image" style="background-image: {{ "url('" . asset('storage/' . $event->gallery->images[0]->path) . "')" }}"></div>
                      @else
                          <div 
                              class="venue-thumbnail cover-image default-image" 
                              style="background-image: {{ "url('" . asset('assets/images/client/images/default-event-image.png') . "'" }}"
                          ></div>
                      @endif
                      <div class="down-content text-center">
                          <h4 class="mb-0">{{ $event->title }}</h4>
                          <p class="position-static my-4">Tanggal: {{ date_format(date_create(explode(' ', $event->transaction->datetime)[0]),"d/m/Y H:i") }}</p>
                          <a href="{{ route('client.gallery.show', $event->slug) }}" class="filled-button mt-2">Lihat Gallery</a>
                      </div>
                  </div>
              </a>
          </div>
          @endforeach
        @else
        <p class="text-center text-muted">Belum Ada Event</p>
        @endif
      </div>
    </div>
  </div>
@endsection