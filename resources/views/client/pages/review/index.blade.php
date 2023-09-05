@extends('client.layouts.app')

@section('review', 'active', 'styles')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>

@section('content')
  <div name="review-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-12">
          <h5>Semua Ulasan</h5>
        </div>
      </div>

      <div class="row mt-4">
        @foreach ($transactions as $trx)
          <div class="col-12">
            <div class="card w-100">
              <div class="card-header">
                <div class="card-title">
                  <h5 class="mb-0 h5">{{ $trx->transaction->user->name }}</h5>
                  <h6 class="text-muted mt-2">{{ $trx->event->title }}</h6>
                  {{-- <h6 class="text-muted">{{ $trx->packet->code }}</h6> --}}
                  <h6 class="text-muted">{{ $trx->venue->name }}</h6>
                </div>
              </div>
              <div class="card-body row">
                <div class="col-12 d-flex gap-2 align-items-center">
                  <p>{{ $trx->review->review }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection