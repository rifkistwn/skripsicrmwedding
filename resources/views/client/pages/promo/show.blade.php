@extends('client.layouts.app')

@section('promo', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/packet/packet-show.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/client/promo/promo-show.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
<div name="promo-show-page-wrapper" class="container">
  <div class="ap-container">
    @if ($promo)
      <div class="row gap-2">
        <div class="col-4">
          <img class="w-100" src="{{ asset("storage/{$promo->packet->image}") }}" alt="packet-image">
        </div>

        <div class="col-7">
          <div class="packet-title">
            {{-- <h4 class="ab-text-primary">{{ $promo->code }}</h4> --}}
            <h5 class="my-2"> {{ $promo->packet->name }}</h5>
          </div>

          <div class="packet-price-cart d-flex gap-5 mt-1 mb-3">
            {{-- <div class="packet-price">
              <h6>Rp. {{ number_format($promo->packet->price) }},-</h6>
            </div> --}}

            <div class="promo-prices">
              <div class="discount my-2 d-flex gap-2 justify-content-start">
                <div class="badge badge-danger d-flex align-items-center">{{ $promo->discount }}%</div>
                <p class="mb-0 price-discount">Rp. {{ number_format($promo->packet->price) }},-</p>
              </div>
              <h5 class="mb-0 font-weight-bold">Rp. {{ number_format($promo->discounted_price) }},-</h5>
            </div>
            
            <div class="packet-cart d-flex gap-2 align-items-center">
              <i class="fa fa-cart-plus" aria-hidden="true"></i>
              <h6 data-toggle="modal" data-target="#selectVenueModal">Masukkan Keranjang</h6>
            </div>
          </div>

          <div class="packet-description">
            <p>{!!html_entity_decode($promo->packet->description)!!}</p>
          </div>
        </div>
      </div>
        
    @else
    <p class="text-center text-muted">Promo tidak ditemukan.</p>
    @endif
  </div>
</div>
@endsection

@if ($promo)
  @section('modals')
    {{-- start::select venue modal --}}
    <div class="modal fade" id="selectVenueModal" tabindex="-1" role="dialog" aria-labelledby="selectVenueModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Pilih Tempat Acara</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('client.cart.store') }}" method="POST" class="add-cart">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <p class="desc">Pilih tempat acara yang mau kamu gunakkan pada paket ini</p>
                  @csrf
                  <select class="selectpicker my-3 form-control" data-live-search="true" name="venue_id">
                    @if($promo->packet->with_venue == 1)
                      <option value="">Not Included</option>
                    @else
                    <option value="{{ $promo->venue_id }}" readonly>{{ $promo->venue->name }}</option>
                    {{-- @foreach ($venues as $venue)
                      <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                    @endforeach --}}
                    @endif
                  </select>
                  <input type="hidden" name="packet_id" value="{{ $promo->packet->id }}">
                  <input type="hidden" name="promo_id" value="{{ $promo->id }}">
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Masukkan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- end::select venue modal --}}
  @endsection
@endif