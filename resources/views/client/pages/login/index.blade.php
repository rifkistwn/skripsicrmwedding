@extends('client.layouts.app')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/login/login.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="login-page-wrapper">
    <div class="ap-container">
      <div class="row mt-n4">
        <div class="col-8">
          <div class="login-illustration cover-image"></div>
        </div>
        <div class="col-4 pr-5">
          <div>
            <div class="ab-logo py-5 d-flex justify-content-center">
              <img src="{{ asset('assets/images/client/images/abie-production-logo.png') }}" alt="abie-production-logo">
            </div>
            <form method="POST" action="{{ route('login')}}">
              @csrf

              @foreach( $errors->all() as $message )
              <div class="alert alert-danger" role="alert">
                {{ $message }}
              </div>
              @endforeach
              
              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="email" name="email" required>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-12">
                  <label for="email" class="form-label">Password</label>
                  <input class="form-control" type="password" name="password" required>
                </div>
              </div>
              <div class="mt-3">
                <button type="submit" class="filled-button">Masuk</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection