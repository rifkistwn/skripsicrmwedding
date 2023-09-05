@extends('client.layouts.app')

@section('index', 'active')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/packet/packet-index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/venue/venue-index.css') }}">
    <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
            <div class="banner-item-01 banner-item">
            </div>
            <div class="banner-item-02 banner-item">
                <div class="text-left container ml-5">
                </div>
            </div>
            <div class="banner-item-03 banner-item">
                <div class="text-left container ml-5">
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    @include('client.components.home.latest-packets')

    @include('client.components.home.favorite-venues')
    
    @include('client.components.home.latest-events')
    
@endsection
