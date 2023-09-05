@extends('client.layouts.app')

@section('shopping-cart', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/shopping-cart/shopping-cart-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="shopping-cart-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row">
        <div class="col-md-12 mb-5">
            <div class="section-heading mb-0">
                <h2>Keranjang</h2>
            </div>
        </div>

        {{-- start::packets card --}}
        @if (count($shopping_carts))
          @foreach ($shopping_carts as $index => $cart)
            <div class="col-12 py-5" name="cart-list">
              <div class="row">
                <div class="col-12">
                  <div class="form-check">
                    <input 
                      data-price="{{ $cart->packet->price }}"
                      data-packet_id="{{ $cart->packet->id }}"
                      data-venue_id="{{ $cart->venue?->id }}"
                      data-promo_id="{{ $cart->promo?->id }}"
                      data-index="{{ $index }}"
                      data-id="{{ $cart->id }}"
                      class="form-check-input" 
                      type="checkbox" 
                      name="cart-check"
                      oninput="sumPriceTotal(this)"
                    >
                    <label class="form-check-label" for="flexCheckDefault">
                      {{ $cart->packet->name }}
                    </label>
                  </div>
                </div>
              </div>
              
              <div class="row mt-3">
                <div class="col-6 d-flex gap-3">
                  <div class="w-50">
                    <div 
                      class="cart-packet-img cover-image"
                      style="background-image: {{ "url('" . asset("storage/{$cart->packet->image}") . "')" }}"
                    ></div>
                  </div>

                  <div class="w-50">
                    <h6 class="font-weight-light">Pilih Tanggal</h6>

                    <div 
                      class="input-group date my-3"
                      onclick="openDatePicker({{ $index }})"
                    > 
                      <input 
                        name="display-date-input-{{ $index }}" 
                        type="text" 
                        class="form-control" 
                        placeholder="Tanggal"
                      >

                      <a href="#" class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                      </a href="#">
                    </div>

                    <input type="date" name="date" id="datepicker-{{ $index }}" class="opacity-0" oninput="changeDisplayDate(this, {{ $index }})">
                  </div>
                </div>
                <div class="col-5 offset-1 d-flex justify-content-between">
                  <div class="price">
                    <h6 class="font-weight-light">Harga</h6>
  
                    <div class="price mt-3">
                      <h5>Rp. {{ number_format($cart->packet->price) }},-</h5>
                    </div>
                  </div>

                  <div class="delete-btn pt-3">
                      <form action="{{ route('client.cart.destroy', $cart->id) }}" method="POST">
                        @csrf
                        
                        <input type="hidden" name="_method" value="delete" />
                        <button type="submit" class="filled-button mt-2 bg-danger">Hapus</button>
                      </form>
                  </div>
                </div>
              </div>
              
            </div>
          @endforeach

          <form action="{{ route('client.transaction.store') }}" method="POST">
            @csrf
            {{-- start::data to input --}}
            <div id='cart-input' class="d-none">
              <input id="price" type="hidden" name="price" value="0">
            </div>
            {{-- end::data to input --}}

            <div class="row py-3">
              <div class="col-6">
                <h6>Total</h6>
              </div>

              <div class="col-6 d-flex justify-content-end">
                <div class="d-flex gap-2 align-items-center">
                  <h6 id="total-price-text">Rp. 0,-</h6>
                  <button class="filled-button" type="submit">Lanjutkan ke Pembayaran</button>
                </div>

              </div>
            </div>
          </form>
        @else
          <p class="text-muted text-center">Keranjang masih kosong</p>
        @endif
        {{-- end::packets card --}}
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('assets/js/client/shopping-cart/shopping-cart-index.js') }}"></script>
@endsection