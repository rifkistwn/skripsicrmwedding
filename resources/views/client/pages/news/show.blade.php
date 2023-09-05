@extends('client.layouts.app')

@section('news', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/news/news-show.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
<div name="news-show-page-wrapper" class="container">
  <div class="ap-container">
    {{-- start::title --}}
    <div class="news-title">
      <h4>{{ $news->title }}</h4>
    </div>
    {{-- end::title --}}

    {{-- star::images --}}
    <div class="images-container row my-4">
      @foreach ($news->images as $index => $image)
        @if (($index + 1) <= 4)
          <div class="col-3">
            <div class="news-image cover-image" style="background-image: {{ "url('" . asset("storage/{$image->path}") }}"></div>
          </div>
        @endif
      @endforeach
    </div>
    {{-- end::images --}}

    {{-- start::description --}}
    <p style="text-align: justify;text-justify: inter-word;">{!!html_entity_decode($news->description)!!}</p>
    {{-- end::description --}}

  </div>
</div>
@endsection