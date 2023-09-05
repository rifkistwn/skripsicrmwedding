@extends('include.app')
@section('title', 'Venue Image')
@section('css')
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><a href="{{route('admin.venue.index')}}">Venue</a> > List Venue Image</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td><a href="{{asset('storage/'.$value->path)}}" target="_blank">View</a></td>
                        <td>
                            <a href="javascript:void(0)" type="button" class="btn btn-danger btn-sm open-delete-modal" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $value->id }}" data-venue_id="{{$venue_id}}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!-- end card-body -->
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Image Tempat Acara</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ $action['upload'] }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label for="id" class="form-label">Image</label>
                            <input type="hidden" name="venue_id" value="{{$venue_id}}">
                            <input class="form-control" type="file" name="image[]" multiple required id="gallery-photo-add">
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
                            @endif
                        </div>
                        <div class="gallery"></div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-sm btn-sm">Upload</button>
                    </div>
                </form>
            </div><!-- end card-body -->
        </div>
    </div> <!-- end col -->
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
                <form action="{{ $action['delete'] }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="venue_id" id="venue_id">
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
<script type="text/javascript">
    $(document).on("click", ".open-delete-modal", function () {
        var id = $(this).data('id');
        var venue_id = $(this).data('venue_id');
        $(".modal-body #id").val(id);
        $(".modal-body #venue_id").val(venue_id);
    })
</script>
@endsection