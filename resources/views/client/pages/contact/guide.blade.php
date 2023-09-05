@extends('client.layouts.app')

@section('contact', 'active', 'styles')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>

@section('content')
  <div name="guide-page-wrapper" class="container mb-5">
    <div class="ap-container">
      <div class="row">
        <div class="col-12">
          <h3>Cara Pemesanan</h3>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-12">
          <ol>
            <li>Daftarkan Akunmu terlebih dahulu dengan melakukan klik pada tombol 'Daftar' di pojok kanan atas, lalu isi form yang dibutuhkan.</li>
            <li>Setelah Akunmu terdaftar, maka lakukan Login dengan klik tombol 'Login' pada pojok kanan atas.</li>
            <li>Setelah Kamu berhasil Login, ayo pilih paket yang seusai dengan kebutuhanmu!</li>
            <li>Pilih Venue yang sesuai juga pastinya</li>
            <li>Lakukan pembayaran dan infokan kepada Kami melalui Nomor Whatsapp yang tertera di petunjuk pembayaran, atau Kamu juga bisa masukkan foto bukti pembayaran Kamu sesuai dengan yang tertera pada petunjuk pembayaran.</li>
            <li>Kamu tinggal duduk manis, maka Admin Abie Production akan menghubungimu sesegera mungkin!</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
@endsection