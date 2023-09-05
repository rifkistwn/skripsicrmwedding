@extends('include.app')
@section('css')
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Upload File</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Upload</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{route('qrcode.upload')}}" method="post" enctype="multipart/form-data" addedfile="test()">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">File</label>
                                        <input type="file" class="form-control" name="file" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" onClick="this.form.reset()"><i class="fa fa-trash"></i>Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        {{-- <div>
                            <form action="{{route('qrcode.upload')}}" method="post" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                                <div class="fallback">
                                    <input name="file" type="file">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                    </div>

                                    <h5>Drop files here or click to upload.</h5>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button onclick="uploadFile()" type="button" class="btn btn-primary waves-effect waves-light">Upload Files</button>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    {{-- <script>
        const dropzoneId = "#dropzone"
        
        $(document).ready(() => {
            const dropzone = Dropzone.forElement(dropzoneId)

            dropzone.options.autoProcessQueue = false
        })

        uploadFile = () => {
            const dropzone = Dropzone.forElement(dropzoneId)

            dropzone.processQueue()
        }
    </script> --}}
@endsection