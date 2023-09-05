@extends('client.layouts.app')

@section('schedule', 'active')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/client/schedule/schedule-index.css') }}">
  <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
@endsection

@section('content')
  <div name="schedule-page-wrapper" class="container">
    <div class="ap-container">
      <div class="row mb-5">
        <div class="col-12">
          <h5 class="text-center">Jadwal Acara</h5>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="w-50">
            <h6 class="font-weight-light">Pilih Tanggal</h6>

            <div 
              class="input-group date my-3"
              onclick="openDatePicker()"
            > 
              <input 
                name="display-date-input" 
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

            <input type="date" name="date" id="datepicker" class="opacity-0" oninput="getEvents(this)">
          </div>
        </div>
      </div>

      {{-- start::events --}}
      <div id="event-list" class="row">

      </div>
      {{-- end::events --}}
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('assets/js/client/schedule/schedule-index.js') }}"></script>
@endsection