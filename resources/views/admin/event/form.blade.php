@extends('include.app')
@section('title', 'Event')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('custom/datetimepicker/jquery.datetimepicker.css')}}">
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Acara</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Judul </label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $data->title }}" required>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">User </label>
                            <input class="form-control" type="text" value="{{ $data->transaction->transaction->user->name }}" readonly>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Paket </label>
                            <input class="form-control" type="text" value="{{ $data->transaction->packet->name }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Tempat Acara </label>
                            <input class="form-control" type="text" value="{{ $data->transaction->venue->name }}" readonly>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Tanggal</label>
                            <input class="form-control datetimepicker" type="text" value="{{ date('d-m-Y H:i', strtotime($data->transaction->datetime)) }}" readonly>
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