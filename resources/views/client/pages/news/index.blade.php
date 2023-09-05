@extends('client.layouts.app')

@section('news', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/news/news-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="news-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
          <div class="col-md-12">
              <div class="section-heading">
                  <h2>Berita</h2>
              </div>
          </div>

          {{-- start::news card --}}
          @if (count($news))
            @foreach ($news as $index => $news_item)
              <div class="col-md-4">
                  <a href="{{ route('client.news.show', $news_item->slug) }}">
                    <div class="product-item card-hover-shadow" name="news-card">
                        <div class="news-thumbnail cover-image" style="background-image: {{ "url('" . asset($news_item->thumbnail) . "')" }}"></div>
                        <div class="down-content">
                          <h4 class="text-center">{{ Str::limit($news_item->title, 50, $end = '...') }}</h4>
                          {{-- <p>{{ Str::limit($news_item->description, 100, $end = '...')}}</p> --}}
                          <p>{!! $news_item->short_description !!}</p>

                          <div class="more">
                            <p class="text-center">Selengkapnya</p>
                          </div>
                        </div>
                    </div>
                  </a>
              </div>
            @endforeach
          @else
            <p class="text-muted text-center">Belum ada berita.</p>
          @endif
          {{-- end::news card --}}
      </div>
    </div>
  </div>
@endsection