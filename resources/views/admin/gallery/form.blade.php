@extends('include.app')
@section('title', 'Gallery')
@section('css')
    <link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('custom/select2/select2.min.css')}}">
    <style>
        body[data-layout-mode=dark] .select2-selection--single{
            background-color: #373c39;
            border-color: #373c39;
        }
        body[data-layout-mode=dark] .select2-selection--single .select2-selection__rendered{
            color: #CED4DA;
        }
        body[data-layout-mode=light] .select2-selection--single{
            border-color: #ced4da;
        }
        .select2-selection.select2-selection--single {
            height: 38.003px;
            display: flex;
            align-items: center;
        }
        .select2-selection.select2-selection--single .select2-selection__arrow{
            top: unset
        }
        .select2.select2-container.select2-container--default{
            width: 100% !important
        }
    </style>
@endsection
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><a href="{{route('admin.gallery.index')}}">Gallery</a> > Detail Gallery</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                    @csrf
                    @method($method)
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Judul </label>
                            <select name="event_id" id="" class="form-select select2" required>
                                <option value="">Silahkan Pilih</option>
                                @foreach($additional['event'] as $event)
                                    @if(!$data->exists)
                                        <option value="{{$event->id}}" @disabled(in_array($event->id, $additional['choosen']->pluck('event_id')->toArray()))> {{ $event->title }} </option>
                                    @else
                                        <option value="{{$event->id}}" @selected($data->event_id == $event->id)> {{ $event->title }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="id" class="form-label">Image </label>
                            <input class="form-control" type="file" name="image[]" multiple id="gallery-photo-add">
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
                            @endif
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-sm btn-sm">{{ !$data->exists ? 'Simpan' : 'Update' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach($additional['images'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td><a href="{{asset('storage/'.$value->path)}}" target="_blank">View</a></td>
                        <td>
                            <a href="javascript:void(0)" type="button" class="btn btn-danger btn-sm open-delete-modal" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $value->id }}" data-gallery_id="{{$data->id}}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- end card-body -->
        </div>
    </div>
</div> <!-- end row -->
<!-- sample modal content -->
<div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Confirmation Dialog</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus? </p>
                <form action="{{ $actionImage['delete'] }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="gallery_id" id="gallery_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan Perubahan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
    <script src="{{asset('custom/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(document).on("click", ".open-delete-modal", function () {
            var id = $(this).data('id');
            var gallery_id = $(this).data('gallery_id');
            $(".modal-body #id").val(id);
            $(".modal-body #gallery_id").val(gallery_id);
        })
    </script>
@endsection