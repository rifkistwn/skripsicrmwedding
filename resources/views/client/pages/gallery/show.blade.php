@extends('client.layouts.app')

@section('gallery', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/gallery/gallery-show.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="gallery-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row mb-4">
        <div class="col-12">
          <h5 class="text-center">{{ $event->title }}</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          @if (count($event->gallery?->images ?? []))
              @foreach ($event->gallery->images as $img)
                <div class="col-12 mb-5"> 
                  <a href="{{ asset('storage/' . $img->path) }}" target="_blank">
                    <img width="100%" src="{{ asset('storage/' . $img->path) }}" alt="gallery-img">
                  </a>
                </div>
              @endforeach
          @else
          <p class="text-center text-muted">Belum Ada Gallery Foto.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection