@extends('include.app')
@section('title', 'Promo')
@section('promo', 'active')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('custom/datetimepicker/jquery.datetimepicker.css')}}">
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Promo</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Paket </label>
                            <select name="packet_id" id="" class="form-select">
                                <option value="">Silahkan Pilih</option>
                                @foreach($additional['packet'] as $packet)
                                    <option value="{{$packet->id}}" @selected($data->packet_id == $packet->id)> {{ $packet->name }} </option>
                                @endforeach
                                </option>
                            </select>
                            @error('packet_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Tempat Acara </label>
                            <select name="venue_id" id="" class="form-select">
                                <option value="">Please Select</option>
                                @foreach($additional['venue'] as $venue)
                                    <option value="{{$venue->id}}" @selected($data->venue_id == $venue->id)> {{ $venue->name }} </option>
                                @endforeach
                                </option>
                            </select>
                            @error('venue_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Kode Promo </label>
                            <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" value="{{ $data->code }}" required>
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Diskon </label>
                            <input class="form-control @error('discount') is-invalid @enderror" type="number" name="discount" value="{{ $data->discount }}" required>
                            @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Maksimal Diskon </label>
                            <input class="form-control @error('max_discount') is-invalid @enderror" type="number" name="max_discount" value="{{ $data->max_discount }}" required>
                            @error('max_discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Tanggal Mulai Periode</label>
                            <input class="form-control datetimepicker" type="text" name="period_start" id="start_date" value="{{ $data->period_start }}" required>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Tanggal Berakhir Periode</label>
                            <input class="form-control datetimepicker" type="text" name="period_end" id="end_date" value="{{ $data->period_end }}" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-sm btn-sm">{{ !$data->exists ? 'Simpan' : 'Update' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('script')
<script src="{{asset('custom/datetimepicker/jquery.datetimepicker.js')}}"></script>

<script>
    $('.datetimepicker').datetimepicker({
        autoclose : true
    });
</script>
@endsection