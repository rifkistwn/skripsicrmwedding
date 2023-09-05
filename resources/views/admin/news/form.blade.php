@extends('include.app')
@section('title', 'News')
@section('css')
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Berita</h4>
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
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Deskripsi </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="content" type="text" name="description" cols="30" rows="6" required> {{ $data->description }} </textarea>
                            @error('description')
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
@section('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 10rem;
            max-height: 35rem;
        }
    </style>
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