@extends('client.layouts.app')

@section('payment', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/payment/payment-show.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="payment-show-page-wrapper" class="container mb-5">
    <div class="ap-container">

      <section name="transaction-detail" class="border-bottom border-muted pb-3">
        <div class="row">
          <div class="col-12 mb-5">
            <div class="section-heading mb-0">
                <h2>Deskripsi Pembayaran</h2>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
            <h6><span class="font-weight-light">Nomor Pesanan Anda :</span> {{ $transaction->id }}</h6>
          </div>
        </div>
  
        {{-- start::packet details --}}
        <div class="row">
          @foreach ($transaction->details as $detail)
            <div class="col-10">
              <h6 class="mb-2">Paket {{ $detail->packet->name }}</h6>
            </div>
            <div class="col-2">
              <h6 class="mb-2 text-right">{{ getPriceText($detail->price) }}</h6>
            </div>
          @endforeach
          <div class="col-10">
            <h6 class="mb-2">Unique Price Code</h6>
          </div>
          <div class="col-2">
            <h6 class="mb-2 text-right">{{ getPriceText($transaction->unique_price_code) }}</h6>
          </div>
        </div>
        {{-- end::packet details --}}
      </section>

      <section name="total-price" class="d-flex justify-content-between py-2">
        <h5>Total</h5>
        <h5>{{ getPriceText($total_price) }}</h5>
      </section>

      <section name="payment-info">
        <div class="row mt-3">
          <div class="col-12">
            <h5><span class="font-weight-light">Harap Transfer sebesar </span>Rp. {{ number_format($total_price) }},-</h5>
            <div class="mt-2">
              <p>Silahkan transfer ke:</p>
              <div class="d-flex justify-content-around my-2">
                <p>BCA: <span class="font-weight-bold">8905525502</span></p>
                <p>BSI: <span class="font-weight-bold">7077942078</span></p>
                <p>Mandiri: <span class="font-weight-bold">1140026529878</span></p>
              </div>
              <p class="text-center">
              (a.n Muhammad Rifki Setiawan)
              </p>

              <p class="mt-2">Jangan lupa kirim screenshot bukti pembayaran Anda ke WhatsApp 082166677345</p>
              <p>Atau upload bukti pembayaran di bawah ini:</p>
              
              <form action="{{ route('client.payment.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row my-4">
                  <div class="col-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image">
                        <label class="custom-file-label" for="inputGroupFile01">Pilih File Bukti Pembayaran..</label>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="filled-button mt-2">Kirim</button>
                  </div>

                  <div class="col-12 mt-3">
                    <p class="font-weight-bold">*Kamu sudah mengupload bukti pembayaran:</p>

                    <a href="{{ asset('storage/' . $transaction->image) }}" target="_blank" title="Lihat Bukti">
                      <img class="my-3 transaction-proof" src="{{ asset('storage/' . $transaction->image) }}" alt="">
                    </a>
                  </div>
                </div>
              </form>

              <p class="mt-2">Jika sudah, kami akan mengirim invoice melalui email dan nomor whatsapp Anda yang terdaftar</p>
              <p>Terimakasih telah memilih Abie Production di hari spesial Anda.</p>
  
              <a class="filled-button mt-2" href="{{ route('client.index') }}">Kembali ke Halaman Awal</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection