@extends('client.layouts.app')

@section('contact', 'active', 'styles')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>

@section('content')
  <div name="contact-page-wrapper" class="container">
    <div class="ap-container">
      <div class="contacts-info">
        <div class="row">
          <div class="col-12 d-flex gap-2 align-items-center mb-2">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <p>Senin - Sabtu, 9 AM - 5 PM</p>
          </div>
          
          <div class="col-12 d-flex gap-2 align-items-center mb-2">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <p>Jl. Sultan Hasanudin, Gunung Mas, Teluk Betung</p>
          </div>

          <div class="col-12 d-flex gap-2 align-items-center mb-2">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <p>0821 666 77 345</p>
          </div>
        </div>
      </div>

      <form class="contact-form mt-3" action="{{ route('client.contact.question') }}" method="POST">
        @csrf
        
        <div class="row">
          <div class="col-12">
            <label for="email" class="form-label">Pertanyaan</label>
            <input class="form-control mb-2" type="text" name="question" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <label for="email" class="form-label">Nama</label>
            <input class="form-control mb-2" type="text" name="name" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input class="form-control mb-2" type="email" name="email" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <label for="email" class="form-label">No. Handphone</label>
            <input class="form-control mb-2" type="number" name="phone" required>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="filled-button mt-2">Kirim</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection