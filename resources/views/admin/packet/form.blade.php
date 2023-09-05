@extends('include.app')
@section('title', 'Promo')
@section('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 10rem;
            max-height: 35rem;
        }
    </style>
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Paket</h4>
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
                        <div class="mb-3 col-4">
                            <label for="id" class="form-label">Harga </label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{ $data->price }}" required>
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label for="id" class="form-label">Kode Paket </label>
                            <input class="form-control @error('code') is-invalid @enderror" type="text" name="code" value="{{ $data->code }}" required>
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-4">
                            <label for="id" class="form-label">Tempat Acara </label>
                            <select name="with_venue" id="" class="form-select">
                                <option value="">Silahkan Pilih</option>
                                <option value="1" @selected($data->with_venue == 1)>Tidak Termasuk</option>
                                <option value="2" @selected($data->with_venue == 2)>Termasuk Tempat Acara</option>
                                </option>
                            </select>
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Deskripsi </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="content" name="description" cols="30" rows="6" required> {{ $data->description }} </textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Image </label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" value="{{ $data->image }}">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <a href="{{ asset( 'storage/' . $data->image )}}" target="_blank"><img src="{{ asset( 'storage/' . $data->image )}}" alt="" width="100px"></a>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <script type="module">
        import imageUploader from "/assets/js/custom/Base64UploadAdapter.js"

        const existedContent = {!! json_encode($content ?? '') !!}

        ClassicEditor
            .create( document.querySelector('#content'), { extraPlugins: [ imageUploader ]})
            .then(editor => {
                if(existedContent) editor.setData(existedContent)
            })
            .catch( error => {
                console.error(error)
            })
    </script>
@endsection