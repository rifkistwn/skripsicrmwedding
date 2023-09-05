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
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Nama </label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $data->name }}" readonly>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">Email </label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $data->email }}" readonly>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label">No. HP</label>
                            <input class="form-control" type="text" name="phone" value="{{ $data->phone}}" readonly>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="id" class="form-label" >Status</label>
                            <select name="status" id="" class="form-select">
                                <option value="0" @selected($data->status == 0)>Banned</option>
                                <option value="1" @selected($data->status == 1)>Active</option>
                            </select>
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

<script>
</script>
@endsection