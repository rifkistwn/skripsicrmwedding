@extends('client.layouts.app')

@section('venue', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/venue/venue-show.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
<div name="venue-show-page-wrapper" class="container mb-5 ">
  <div class="ap-container">
    {{-- start::title --}}
    <div class="venue-title">
      <h4>{{ $venue->name }}</h4>
    </div>
    {{-- end::title --}}

    {{-- star::images --}}
    <div class="images-container row my-4">
      @foreach ($venue->images as $index => $image)
        @if (($index + 1) <= 4)
          <div class="col-3">
            <div class="venue-image cover-image" style="background-image: {{ "url('" . asset("storage/{$image->path}") }}"></div>
          </div>
        @endif
      @endforeach
    </div>
    {{-- end::images --}}

    {{-- start::venue details --}}
    <div class="row">
      <div class="col-12">
        <div class="venue-address">      
          <h5>Kapasitas</h5>
          
          <p>{{ $venue->capacity }} orang</p>
        </div>
      </div>

      <div class="col-12 mt-3">
        <div class="venue-capacity">      
          <h5>Alamat</h5>
          
          <p>{{ $venue->address }}</p>
        </div>
      </div>
    </div>

    {{-- end::venue details --}}

  </div>
</div>
@endsection