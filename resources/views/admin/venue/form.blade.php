@extends('include.app')
@section('title', 'Venue')
@section('css')
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Tempat Acara</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Nama </label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $data->name }}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Kapasitas </label>
                            <input class="form-control @error('capacity') is-invalid @enderror" type="number" name="capacity" value="{{ $data->capacity }}" required>
                            @error('capacity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Alamat </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" type="text" name="address" cols="30" rows="6" required> {{ $data->address }} </textarea>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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

@endsection