@extends('include.app')
@section('title', ' - Venue')
@section('css')
@endsection
@section('content')
<link rel="icon" type="image/png" href="{{asset('assets/images/client/images/abie-production-logo.png')}}"/>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">List Tempat Acara</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="card-title">List Tempat Acara</h4>
                        </div>
                        <div class="col-sm-2 d-flex justify-content-end">
                            <a class="btn btn-primary w-sm btn-sm" href="{{route('admin.venue.create')}}" >Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered dt-responsive nowrap w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        const url = "{{ route('admin.venue.index') }}"

        var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            aaSorting : [],
            ajax: url,
            scrollX : true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name' },
                { data: 'capacity' },
                { data: 'action',orderable: false, searchable: false,},
            ]
        })
    })
</script>
@endsection