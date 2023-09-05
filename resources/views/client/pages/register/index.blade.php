@extends('client.layouts.app')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/login/login.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="register-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row mt-n5 d-flex justify-content-center">
        <div class="col-8">
          <div>
            <div class="ab-logo py-5 d-flex justify-content-center">
              <img src="{{ asset('assets/images/client/images/logo-daftar.png') }}" alt="abie-production-logo">
            </div>

            <h5 class="text-center mb-2">Daftar Akun Baru</h5>
            <form method="POST" action="{{ route('client.register.store')}}">
              @csrf

              @foreach( $errors->all() as $message )
              <div class="alert alert-danger" role="alert">
                {{ $message }}
              </div>
              @endforeach
              
              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Nama Lengkap</label>
                  <input class="form-control" type="text" name="name" required>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="email" name="email" required>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Nomor Telepon</label>
                  <input class="form-control" type="number" name="phone" required>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Password</label>
                  <input class="form-control" type="password" name="password" required>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Konfirmasi Password</label>
                  <input class="form-control" type="password" name="password_confirmation" required>
                </div>
              </div>
              <div class="mt-3">
                <button type="submit" class="filled-button">Daftar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection