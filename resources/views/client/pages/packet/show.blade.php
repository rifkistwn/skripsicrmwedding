@extends('client.layouts.app')

@section('packet', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/packet/packet-show.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/client/promo/promo-show.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
<div name="packet-show-page-wrapper" class="container">
  <div class="ap-container">
    <div class="row">
      <div class="col-2">
        <img class="w-100" src="{{ asset("storage/{$packet->image}") }}" alt="packet-image">
      </div>

      <div class="col-10">
        <div class="packet-title">
          <h4>{{ $packet->name }}</h4>
        </div>

        <div class="packet-price-cart d-flex gap-5 my-3">
          @if ($packet->active_promo)
            <div class="promo-prices">
              <div class="discount my-2 d-flex gap-2 justify-content-start">
                <div class="badge badge-danger d-flex align-items-center">{{ $packet->active_promo->discount }}%</div>
                <p class="mb-0 price-discount">Rp. {{ number_format($packet->price) }},-</p>
              </div>
              <h5 class="mb-0 font-weight-bold">Rp. {{ number_format($packet->discounted_price) }},-</h5>
            </div>
          @else
            <div class="packet-price">
              <div class="discount my-2 d-flex gap-2 justify-content-start">
                <h6 class="mt-3 price-discount">Rp. {{ number_format($packet->price) }},-</h6>
              </div>
            </div>
          @endif
          <div class="packet-cart d-flex gap-2 align-items-center">
          <label for="">Tempat Acara:</label>
          <select class="selectpicker my-3 form-control" data-live-search="true" @disabled($packet->with_venue == 1) id="venue">
            <option value="" @disabled($packet->with_venue == 2)>Not Included</option>
            @if($packet->active_promo)
              @if($packet->with_venue == 1)
                <option value="">Not Included</option>
              @else
                <option value="{{ $packet->active_promo->venue_id }}" readonly>{{ $packet->active_promo->venue->name }}</option>
              @endif
            @else
              @foreach ($venues as $venue)
                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
              @endforeach
            @endif
          </select>
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            <h6 data-toggle="modal" data-target="#confirmationDialog" onclick= "buildData()">Masukkan Keranjang</h6>
          </div>
        </div>
        <div class="packet-description">
          <p>{!!html_entity_decode($packet->description)!!}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('modals')
  {{-- start::select venue modal --}}
  <div class="modal fade" id="confirmationDialog" tabindex="-1" role="dialog" aria-labelledby="confirmationDialogTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('client.cart.store') }}" method="POST" class="add-cart">
          <div class="modal-body">
            <p class="desc">Apakah kamu yakin ingin menambahkan keranjang?</p>
            @csrf
            <input type="hidden" name="packet_id" value="{{ $packet->id }}">
            <input type="hidden" name="venue_id" id="venue_id">
            <input type="hidden" name="promo_id" value="{{ $packet->active_promo ? $packet->active_promo->id : null }}">
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
@section('scripts')
  <script text="javascript">
    function buildData(){
      let venue_id = $('#venue').val()
      $('#venue_id').val(venue_id)
    }
  </script>
@endsection